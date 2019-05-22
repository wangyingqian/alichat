<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Symfony\Component\HttpFoundation\Request;
use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Kernel\WechatRequest;
use Wangyingqian\AliChat\Support\Str;

/**
 * app 支付
 *
 * Class App
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class App extends Wechat
{
    public function __construct()
    {
        $this->method = 'pay/unifiedorder';

        $this->tradeType = 'APP';

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
            'appid'     => $config->get('mode') === WechatRequest::MODE_SERVICE
                ? $config->get('sub_appid')
                : $config->get('appid'),
            'partnerid' => $config->get('mode') === WechatRequest::MODE_SERVICE
                ? $config->get('sub_mch_id')
                : $config->get('mch_id'),
            'prepayid'  => $data['prepay_id'],
            'timestamp' => strval(time()),
            'noncestr'  => Str::random(),
            'package'   => 'Sign=WXPay',
        ];

        $params['sign'] = $request->generateSign($params);

        return $request->json($params);
    }
}