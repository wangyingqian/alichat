<?php
namespace Wangyingqian\AliChat\Application;

use Symfony\Component\HttpFoundation\Request;
use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Exception\AliChatException;
use Wangyingqian\AliChat\Kernel\WechatRequest;
use Wangyingqian\AliChat\Support\Str;

class WechatManage extends Manage
{

    public function init()
    {
        $this->payload = [
            'appid'            => $this->container['config']->get('wechat,app_id', ''),
            'mch_id'           => $this->container['config']->get('wechat.mch_id', ''),
            'nonce_str'        => Str::random(),
            'notify_url'       => $this->container['config']->get('wechat.notify_url', ''),
            'sign'             => '',
            'trade_type'       => '',
            'spbill_create_ip' => Request::createFromGlobals()->getClientIp(),
        ];

        if ($this->container['config']->get('wechat.mode', WechatRequest::MODE_NORMAL) === WechatRequest::MODE_SERVICE) {
            $this->payload = array_merge($this->payload, [
                'sub_mch_id' => $this->container['config']->get('sub_mch_id'),
                'sub_appid'  => $this->container['config']->get('sub_app_id', ''),
            ]);
        }
    }

    public function run($params, $method, $gateway)
    {
        $this->payload['return_url'] = $params['return_url'] ?? $this->payload['return_url'];
        $this->payload['notify_url'] = $params['notify_url'] ?? $this->payload['notify_url'];

        unset($params['return_url'], $params['notify_url']);
        $this->payload['biz_content'] = json_encode($params);

        $object = $this->getGateWay($method, $gateway);

        if (!is_subclass_of($object, Wechat::class)){
            throw new AliChatException('Object without inheritance form'. Wechat::class);
        }

        $return = $object->getReturn();

        $this->payload['method'] = $return['method'];

        return $this->container['wechat.request']->requestApi($this->payload);
    }

}