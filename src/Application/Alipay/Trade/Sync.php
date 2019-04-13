<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 支付宝订单信息同步
 *
 * Class Sync
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Sync extends Alipay
{
    protected $method = 'alipay.trade.orderinfo.sync';
}