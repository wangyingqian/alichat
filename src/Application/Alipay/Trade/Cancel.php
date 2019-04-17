<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 支付交易返回失败或支付系统超时，撤销交易
 *
 * Class Cancel
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Cancel extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.trade.cancel';
    }
}