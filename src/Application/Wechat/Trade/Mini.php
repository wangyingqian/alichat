<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Symfony\Component\HttpFoundation\Request;
use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Kernel\WechatRequest;
use Wangyingqian\AliChat\Support\Str;

/**
 * 小程序 支付
 *
 * Class App
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class Mini extends Wechat
{
    public function __construct()
    {
        $this->method = 'pay/unifiedorder';

        $this->tradeType = 'JSAPI';

        $this->params = [
            'spbill_create_ip' => Request::createFromGlobals()->getClientIp(),
        ];
    }

    public function handle($data)
    {
        /** @var Config $config */
        $config = $this->container['config'];
        /** @var WechatRequest $request */
        $request = $this->container['wechat.request'];

        $params = [
            'appId'     => $config->get('mode') == WechatRequest::MODE_SERVICE ? $config->get('sub_appid') : $config->get('appid'),
            'timeStamp' => strval(time()),
            'nonceStr'  => Str::random(),
            'package'   => 'prepay_id='.$data['prepay_id'],
            'signType'  => 'MD5',
        ];
        $params['paySign'] = $request->generateSign($params);

        return $request->json($params);
    }
}