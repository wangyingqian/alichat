<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 关闭未交易订单
 *
 * Class Close
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Close extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.trade.close';
    }
}