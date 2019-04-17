<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

/**
 * App 唤起支付
 *
 * Class App
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class App extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.trade.app.pay';

        $this->request = AlipayManage::SDK_REQUEST;
    }
}