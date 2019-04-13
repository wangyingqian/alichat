<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 资金授权操作查询
 *
 * Class Query
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Fund
 */
class Query extends Alipay
{
    protected $method = 'alipay.fund.auth.operation.detail.query';
}