<?php
namespace Wangyingqian\AliChat\Kernel;

use Wangyingqian\AliChat\Exception\AliChatException;
use Wangyingqian\AliChat\Exception\InvalidSignException;
use Wangyingqian\AliChat\Support\Log;
use Wangyingqian\AliChat\Support\Str;
use Wangyingqian\AliChat\Support\Traits\HttpRequestTrait;

class WechatRequest
{
    use HttpRequestTrait;

    /**
     * 普通模式.
     */
    const MODE_NORMAL = 'normal';

    /**
     * 沙箱模式.
     */
    const MODE_DEV = 'dev';

    /**
     * 香港钱包 API.
     */
    const MODE_HK = 'hk';

    /**
     * 境外 API.
     */
    const MODE_US = 'us';

    /**
     * 服务商模式.
     */
    const MODE_SERVICE = 'service';

    /**
     * 公众号
     */
    const MODE_ACCOUNT = 'account';

    /**
     * Const url.
     */
    const URL = [
        self::MODE_NORMAL  => 'https://api.mch.weixin.qq.com/',
        self::MODE_DEV     => 'https://api.mch.weixin.qq.com/sandboxnew/',
        self::MODE_HK      => 'https://apihk.mch.weixin.qq.com/',
        self::MODE_SERVICE => 'https://api.mch.weixin.qq.com/',
        self::MODE_US      => 'https://apius.mch.weixin.qq.com/',
        self::MODE_ACCOUNT => 'https://api.weixin.qq.com/',
    ];


    protected $mode;

    /**
     * Wechat gateway.
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


    public function __construct(Config $config)
    {
        $this->baseUri = self::URL[$this->mode = $config->get('mode', self::MODE_NORMAL)];

        $this->config = $config;

        $this->setHttpOptions();

        $this->setDevKey();
    }

    /**
     * pay request
     *
     * @param $endpoint
     * @param $payload
     * @param bool $cert
     *
     * @return array
     *
     * @throws AliChatException
     * @throws InvalidSignException
     */
    public function payRequest($endpoint, $payload, $cert = false)
    {
        if ($this->mode ===self::MODE_SERVICE) {
            $payload = array_merge($payload, [
                'sub_mch_id' => $this->config->get('sub_mch_id'),
                'sub_appid'  => $this->config->get('sub_appid', ''),
            ]);
        }

        $result = $this->post(
            $endpoint,
            self::toXml($payload),
            $cert ? [
                'cert'    => $this->config->get('cert_client'),
                'ssl_key' => $this->config->get('cert_key'),
            ] : []
        );
        $result = is_array($result) ? $result : $this->fromXml($result);

        return $this->processingApiResult($endpoint, $result);
    }

    /**
     * account request
     *
     * @param $endpoint
     * @param $payload
     *
     * @return array|string
     */
    public function accountRequest($endpoint, $payload)
    {
//        $accessToken = $this->config->get('access_token');
//        if (!empty($accessToken)){
//            $endpoint = $endpoint .'?access_token='. $accessToken;
//            unset($payload['access_token']);
//        }

        $result = $this->post($endpoint, $payload);

        return $result;
    }

    /**
     * generate sign
     *
     * @param $data
     *
     * @return string
     */
    public function generateSign($data)
    {
        $key = $this->config->get('key');

        if (is_null($key)) {
            throw new \InvalidArgumentException('Missing Wechat Config -- [key]');
        }

        ksort($data);

        $string = md5(self::getSignContent($data).'&key='.$key);

        Log::debug('Wechat Generate Sign Before UPPER', [$data, $string]);

        return strtoupper($string);
    }

    /**
     * get sign
     *
     * @param $data
     *
     * @return string
     */
    public function getSignContent($data)
    {
        $buff = '';

        foreach ($data as $k => $v) {
            $buff .= ($k != 'sign' && $v != '' && !is_array($v)) ? $k.'='.$v.'&' : '';
        }

        Log::debug('Wechat Generate Sign Content Before Trim', [$data, $buff]);

        return trim($buff, '&');
    }

    /**
     * decrypt refund contents
     *
     * @param $contents
     *
     * @return string
     */
    public function decryptRefundContents($contents)
    {
        return openssl_decrypt(
            base64_decode($contents),
            'AES-256-ECB',
            md5($this->getConfig('key'),
            OPENSSL_RAW_DATA
        ));
    }

    /**
     * convert array to xml
     *
     * @param $data
     *
     * @return string
     */
    public function toXml($data)
    {
        if (!is_array($data) || count($data) <= 0) {
            throw new \InvalidArgumentException('Convert To Xml Error! Invalid Array!');
        }

        $xml = '<xml>';
        foreach ($data as $key => $val) {
            $xml .= is_numeric($val) ? '<'.$key.'>'.$val.'</'.$key.'>' :
                '<'.$key.'><![CDATA['.$val.']]></'.$key.'>';
        }
        $xml .= '</xml>';

        return $xml;
    }

    /**
     * convert xml to array
     *
     * @param $xml
     *
     * @return array
     */
    public function fromXml($xml)
    {
        if (!$xml) {
            throw new \InvalidArgumentException('Convert To Array Error! Invalid Xml!');
        }

        libxml_disable_entity_loader(true);

        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE), true);
    }

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

    public function setConfig($key, $value)
    {
        $this->config->set($key, $value);
    }

    public function getBaseUri()
    {
        return $this->baseUri;
    }

    /**
     * process result
     *
     * @param $endpoint
     * @param array $result
     *
     *
     * @throws AliChatException
     * @throws InvalidSignException
     */
    protected function processingApiResult($endpoint, array $result)
    {
        if (!isset($result['return_code']) || $result['return_code'] != 'SUCCESS') {
            throw new AliChatException(
                'Get Wechat API Error:'.($result['return_msg'] ?? $result['retmsg'] ?? ''),
                $result
            );
        }

        if (isset($result['result_code']) && $result['result_code'] != 'SUCCESS') {
            throw new AliChatException(
                'Wechat Business Error: '.$result['err_code'].' - '.$result['err_code_des'],
                $result
            );
        }

        if ($endpoint === 'pay/getsignkey' ||
            strpos($endpoint, 'mmpaymkttransfers') !== false ||
            self::generateSign($result) === $result['sign']) {

            return (method_exists($wechat = $this->config->get('wechat'), 'handle'))
                ? $wechat->handle($result)
                : $result;
        }

        throw new InvalidSignException('Wechat Sign Verify FAILED', $result);
    }

    /**
     * set dev key
     *
     * @throws AliChatException
     *
     * @throws InvalidSignException
     */
    private function setDevKey()
    {
        if ($this->mode  == self::MODE_DEV) {
            $data = [
                'mch_id'    => $this->config->get('mch_id'),
                'nonce_str' => Str::random(),
            ];

            $data['sign'] = $this->generateSign($data);

            $result = $this->requestApi('pay/getsignkey', $data);

            $this->config->set('key', $result['sandbox_signkey']);
        }
    }

    /**
     * set http option
     *
     * @return $this
     */
    private function setHttpOptions()
    {
        if ($this->config->has('http') && is_array($this->config->get('http'))) {
            $this->config->forget('http.base_uri');
            $this->httpOptions = $this->config->get('http');
        }

        return $this;
    }
}
