<?php
namespace Wangyingqian\AliChat\Kernel;

use Wangyingqian\AliChat\Exception\InvalidConfigException;
use Wangyingqian\AliChat\Exception\InvalidSignException;
use Wangyingqian\AliChat\Exception\RequestException;
use Wangyingqian\AliChat\Support\Arr;
use Wangyingqian\AliChat\Support\Collection;
use Wangyingqian\AliChat\Support\Http;
use Wangyingqian\AliChat\Support\Log;
use Wangyingqian\AliChat\Support\Str;
use Wangyingqian\AliChat\Support\Traits\HttpRequestTrait;

class AlipayRequest
{
    use HttpRequestTrait;

    /**
     * Const mode_normal.
     */
    const MODE_NORMAL = 'normal';

    /**
     * Const mode_dev.
     */
    const MODE_DEV = 'dev';

    /**
     * Const url.
     */
    const URL = [
        self::MODE_NORMAL => 'https://openapi.alipay.com/gateway.do',
        self::MODE_DEV    => 'https://openapi.alipaydev.com/gateway.do',
    ];

    /**
     * Alipay gateway.
     *
     * @var string
     */
    protected $baseUri;

    /**
     * Config.
     *
     * @var Config
     */
    protected $config;

    /**
     * Bootstrap.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->baseUri = self::URL[$config->get('alipay.mode', self::MODE_NORMAL)];
        $this->config = $config;

        $this->setHttpOptions();
    }


    /**
     *  execute request
     *
     * @param array $data
     *
     * @return Collection
     *
     * @throws InvalidConfigException
     * @throws InvalidSignException
     * @throws RequestException
     */
    public function apiRequest(array $data)
    {
        $data = array_filter($data, function ($value) {
            return ($value == '' || is_null($value)) ? false : true;
        });

        $result = $this->encoding($this->post('', $data),'utf-8', 'gb2312');

        return $this->processingApiResult($data, $result);
    }

    /**
     * page request
     *
     * @param $data
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Http
     */
    public function pageRequest($data)
    {
        $data = array_filter($data, function ($value) {
            return ($value == '' || is_null($value)) ? false : true;
        });

        $method = $data['http_method'] ?? 'POST';

        if (strtoupper($method) === 'GET') {
            return Http::redirect($this->baseUri.'?'.$this->sdkRequest($data));
        }

        $sHtml = "<form id='alipay_submit' name='alipay_submit' action='".$this->baseUri."' method='.$method.'>";
        foreach ($data as $key => $val) {
            $val = str_replace("'", '&apos;', $val);
            $sHtml .= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }
        $sHtml .= "<input type='submit' value='ok' style='display:none;'></form>";
        $sHtml .= "<script>document.forms['alipay_submit'].submit();</script>";

        return Http::respond($sHtml);
    }

    /**
     * sdk Request
     *
     * @param $data
     *
     * @return string
     */
    public function sdkRequest($data)
    {
        $data = array_filter($data, function ($value) {
            return ($value == '' || is_null($value)) ? false : true;
        });

        return htmlspecialchars(Arr::query($data));
    }


    /**
     * Generate sign.
     *
     * @param array $params
     *
     * @throws InvalidConfigException
     *
     * @return string
     */
    public function generateSign(array $params)
    {
        $privateKey = $this->config->get('alipay.private_key');

        if (is_null($privateKey)) {
            throw new InvalidConfigException('Missing Alipay Config -- [private_key]');
        }

        if (Str::endsWith($privateKey, '.pem')) {
            $privateKey = openssl_pkey_get_private($privateKey);
        } else {
            $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".
                wordwrap($privateKey, 64, "\n", true).
                "\n-----END RSA PRIVATE KEY-----";
        }

        openssl_sign(self::getSignContent($params), $sign, $privateKey, OPENSSL_ALGO_SHA256);

        $sign = base64_encode($sign);

        Log::debug('Alipay Generate Sign', [$params, $sign]);

        return $sign;
    }

    /**
     * Verify sign.
     *
     * @param array       $data
     * @param bool        $sync
     * @param string|null $sign
     *
     * @throws InvalidConfigException
     *
     * @return bool
     */
    public function verifySign(array $data, $sync = false, $sign = null)
    {
        $publicKey = $this->ali_public_key;

        if (is_null($publicKey)) {
            throw new InvalidConfigException('Missing Alipay Config -- [ali_public_key]');
        }

        if (Str::endsWith($publicKey, '.pem')) {
            $publicKey = openssl_pkey_get_public($publicKey);
        } else {
            $publicKey = "-----BEGIN PUBLIC KEY-----\n".
                wordwrap($publicKey, 64, "\n", true).
                "\n-----END PUBLIC KEY-----";
        }

        $sign = $sign ?? $data['sign'];

        $toVerify = $sync ? mb_convert_encoding(json_encode($data, JSON_UNESCAPED_UNICODE), 'gb2312', 'utf-8') :
            $this->getSignContent($data, true);

        return openssl_verify($toVerify, base64_decode($sign), $publicKey, OPENSSL_ALGO_SHA256) === 1;
    }

    /**
     * Get signContent that is to be signed.
     *
     * @param array $data
     * @param bool  $verify
     *
     * @return string
     */
    public function getSignContent(array $data, $verify = false)
    {
        $data = $this->encoding($data, $data['charset'] ?? 'gb2312', 'utf-8');

        ksort($data);

        $stringToBeSigned = '';
        foreach ($data as $k => $v) {
            if ($verify && $k != 'sign' && $k != 'sign_type') {
                $stringToBeSigned .= $k.'='.$v.'&';
            }
            if (!$verify && $v !== '' && !is_null($v) && $k != 'sign' && '@' != substr($v, 0, 1)) {
                $stringToBeSigned .= $k.'='.$v.'&';
            }
        }

        Log::debug('Alipay Generate Sign Content Before Trim', [$data, $stringToBeSigned]);

        return trim($stringToBeSigned, '&');
    }

    /**
     * Convert encoding.
     *
     * @param string|array $data
     * @param string       $to
     * @param string       $from
     *
     * @return array
     */
    public function encoding($data, $to = 'utf-8', $from = 'gb2312')
    {
        return Arr::encoding(Arr::wrap($data), $to, $from);
    }

    /**
     * Get service config.
     *
     * @param null|string $key
     * @param null|mixed  $default
     *
     * @return mixed|null
     */
    public function getConfig($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->config->all();
        }

        if ($this->config->has($key)) {
            return $this->config[$key];
        }

        return $default;
    }

    /**
     * Get Base Uri.
     *
     * @return string
     */
    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * processingApiResult
     *
     * @param $data
     * @param $result
     * @return Collection
     * @throws InvalidConfigException
     * @throws InvalidSignException
     *
     * @throws RequestException
     */
    protected function processingApiResult($data, $result)
    {
        $method = str_replace('.', '_', $data['method']).'_response';

        if (!isset($result['sign']) || $result[$method]['code'] != '10000') {
            throw new RequestException(
                'Get Alipay API Error:'.$result[$method]['msg'].
                (isset($result[$method]['sub_code']) ? (' - '.$result[$method]['sub_code']) : ''),
                $result
            );
        }

        if (self::verifySign($result[$method], true, $result['sign'])) {
            return new Collection($result[$method]);
        }


        throw new InvalidSignException('Alipay Sign Verify FAILED', $result);
    }

    /**
     * Set Http options.
     *
     * @return self
     */
    protected function setHttpOptions()
    {
        if ($this->config->has('alipay.http') && is_array($this->config->get('alipay.http'))) {
            $this->config->forget('alipay.http.base_uri');
            $this->httpOptions = $this->config->get('alipay.http');
        }

        return $this;
    }
}
