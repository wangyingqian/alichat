<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\AlipayManage;
use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * PC 收单下单并支付
 *
 * Class Web
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Web extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.trade.page.pay';

        $this->request = AlipayManage::PAGE_REQUEST;
    }
}
