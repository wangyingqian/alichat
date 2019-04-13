<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 统一收单线下交易查询
 *
 * Class Query
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Query extends Alipay
{
    protected $method = 'alipay.trade.query';
}