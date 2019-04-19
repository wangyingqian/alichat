<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Wangyingqian\AliChat\Application\Wechat\Wechat;

/**
 * 退款查询
 *
 * Class RefundQuery
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class RefundQuery extends Wechat
{
    protected $method = 'pay/refundquery';
}