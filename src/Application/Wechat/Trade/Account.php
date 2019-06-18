<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Symfony\Component\HttpFoundation\Request;
use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Kernel\WechatRequest;
use Wangyingqian\AliChat\Support\Str;

/**
 * 公众号 支付
 *
 * Class App
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class Account extends Wechat
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
            'appId'     => $config->get('appid'),
            'timeStamp' => strval(time()),
            'nonceStr'  => Str::random(),
            'package'   => 'prepay_id='.$data['prepay_id'],
            'signType'  => 'MD5',
        ];
        $params['paySign'] = $request->generateSign($params);

        return $request->json($params);
    }
}