<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 收单交易退款查询
 *
 * Class RefundQuery
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class RefundQuery extends Alipay
{
    protected $method = 'alipay.trade.fastpay.refund.query';
}