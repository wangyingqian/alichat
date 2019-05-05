<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Exception\AliChatException;
use Wangyingqian\AliChat\Support\Str;

class WechatManage extends Manage
{

    public function init()
    {
        $this->payload = [
            'appid'            => '',
            'mch_id'           => '',
            'nonce_str'        =>Str::random()
        ];
    }

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

        $this->payload['sign'] = $this->container['wechat.request']->generateSign($this->payload);

        return $this->container['wechat.request']->requestApi($return['method'], $this->payload);
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

}