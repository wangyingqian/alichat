<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Exception\AliChatException;
use Wangyingqian\AliChat\Support\Str;

class WechatManage extends Manage
{
    /**
     * 支付请求
     */
    const PAY_REQUEST = 'pay';

    /**
     * 公众号请求
     */
    const ACCOUNT_REQUEST = 'account';

    /**
     * 第三方平台请求
     */
    const OPEN_REQUEST = 'open';

//    public function init()
//    {
//        $this->payload = [
//            'appid'            => '',
//            'mch_id'           => '',
//            'nonce_str'        =>Str::random()
//        ];
//    }

    public function run($gateway, $method)
    {
        $this->parseParams();

        $object = $this->getGateWay($method, $gateway);

        if (!is_subclass_of($object, Wechat::class)){
            throw new AliChatException('Object without inheritance form'. Wechat::class);
        }

        $return = $object->getReturn();

        $this->payload['trade_type'] = $return['trade_type'];

        foreach ($return['params'] ?? [] as $k =>$v){
            $this->payload[$k] = $v;
        }

        $this->payload = array_filter($this->payload);

        return $this->request($return['method'],$return['request'] ?: self::PAY_REQUEST);
    }

    protected function request($endpoint, $type)
    {
        if (!in_array($type, [self::PAY_REQUEST, self::ACCOUNT_REQUEST, self::OPEN_REQUEST])){
            throw new AliChatException('request tpye error');
        }

        switch ($type){
            case self::PAY_REQUEST:
                $this->payload['sign'] = $this->container['wechat.request']->generateSign($this->payload);
                return $this->container['wechat.request']->payRequest($endpoint, $this->payload);
            case self::ACCOUNT_REQUEST:
                return $this->container['wechat.request']->accountRequest($endpoint, $this->payload);
            case self::OPEN_REQUEST:
                return $this->container['wechat.request']->openRequest($endpoint, $this->payload);
        }

        return true;
    }

    /**
     * 过滤参数
     */
    protected function parseParams()
    {
        $params = $this->container['config']->all();

        $ignoreParams = [
            'http',
            'log',
            'cert_client',
            'cert_key',
            'mode',
            'key'
        ];

        foreach ($params as $k =>$v){

            if (in_array($k, $ignoreParams)) continue;

            $this->payload[$k] = $v;
        }
    }

    public function fromXml($xml)
    {
        return $this->container['wechat.request']->fromXml($xml);
    }

    public function toXml($array)
    {
        return $this->container['wechat.request']->toXml($array);
    }
}