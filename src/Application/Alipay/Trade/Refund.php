<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 退款
 *
 * Class Refund
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Refund extends Alipay
{
    protected $method = 'alipay.trade.refund';
}