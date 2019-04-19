<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Symfony\Component\HttpFoundation\Request;
use Wangyingqian\AliChat\Application\Wechat\Wechat;

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
}