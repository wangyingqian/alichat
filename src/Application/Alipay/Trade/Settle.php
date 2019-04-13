<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 线下结算
 *
 * Class Settle
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Settle extends Alipay
{
    protected $method = 'alipay.trade.order.settle';
}