<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 扫码资金授权冻结
 *
 * Class Freeze
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class PosFreeze extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.fund.auth.order.freeze';
    }
}