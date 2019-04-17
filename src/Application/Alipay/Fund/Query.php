<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 资金预授权操作查询
 *
 * Class Query
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Fund
 */
class Query extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.fund.auth.operation.detail.query';
    }
}