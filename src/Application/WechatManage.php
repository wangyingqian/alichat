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
            'appid'            => $this->container['config']->get('wechat.app_id', ''),
            'mch_id'           => $this->container['config']->get('wechat.mch_id', ''),
            'nonce_str'        =>Str::random()
        ];
    }

    public function run($params, $method, $gateway)
    {
        $this->payload += $params;

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

}