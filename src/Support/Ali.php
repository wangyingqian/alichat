<?php

namespace Wangyingqian\AliChat\Support;

use function Couchbase\defaultDecoder;
use Wangyingqian\AliChat\Application\Alipay;
use Wangyingqian\AliChat\Exception\InvalidConfigException;
use Wangyingqian\AliChat\Exception\InvalidSignException;
use Wangyingqian\AliChat\Exception\RequestException;
use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Support\Traits\HttpRequestTrait;

/**
 *
 * @property string app_id alipay app_id
 * @property string ali_public_key
 * @property string private_key
 * @property array http http options
 * @property string mode current mode
 * @property array log log options
 */
class Ali
{
    use HttpRequestTrait;

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
     * Instance.
     *
     * @var Ali
     */
    private static $instance;

    /**
     * Bootstrap.
     *
     * @param Config $config
     */
    private function __construct(Config $config)
    {
        $this->baseUri = Alipay::URL[$config->get('mode', Alipay::MODE_NORMAL)];
        $this->config = $config;

        $this->setHttpOptions();
    }

    /**
     * __get.
     *
     * @param $key
     *
     * @return mixed|null|Config
     */
    public function __get($key)
    {
        return $this->getConfig($key);
    }

    /**
     * create.
     *
     * @param Config $config
     *
     * @return Ali
     */
    public static function create(Config $config)
    {
        if (php_sapi_name() === 'cli' || !(self::$instance instanceof self)) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    /**
     * clear.
     *
     * @return void
     */
    public function clear()
    {
        self::$instance = null;
    }

    /**
     * request
     *
     * @param array $data
     * @return Collection
     * @throws InvalidConfigException
     * @throws InvalidSignException
     *
     * @throws RequestException
     */
    public static function requestApi(array $data): Collection
    {
        $data = array_filter($data, function ($value) {
            return ($value == '' || is_null($value)) ? false : true;
        });

        $result = mb_convert_encoding(self::$instance->post('', $data), 'utf-8', 'gb2312');

        $result = json_decode($result, true);

        return self::processingApiResult($data, $result);
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
    public static function generateSign(array $params): string
    {
        $privateKey = self::$instance->private_key;

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
    public static function verifySign(array $data, $sync = false, $sign = null): bool
    {
        $publicKey = self::$instance->ali_public_key;

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
            self::getSignContent($data, true);

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
    public static function getSignContent(array $data, $verify = false): string
    {
        $data = self::encoding($data, $data['charset'] ?? 'gb2312', 'utf-8');

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
    public static function encoding($data, $to = 'utf-8', $from = 'gb2312'): array
    {
        return Arr::encoding((array) $data, $to, $from);
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
    protected static function processingApiResult($data, $result): Collection
    {

        $method = str_replace('.', '_', $data['method']).'_response';
        var_dump($result);die;
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
    protected function setHttpOptions(): self
    {
        if ($this->config->has('http') && is_array($this->config->get('http'))) {
            $this->config->forget('http.base_uri');
            $this->httpOptions = $this->config->get('http');
        }

        return $this;
    }
}
