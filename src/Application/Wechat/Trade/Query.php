<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Wangyingqian\AliChat\Application\Wechat\Wechat;

/**
 * 查询订单
 *
 * Class Query
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class Query extends Wechat
{
    public function __construct()
    {
        $this->method = 'pay/orderquery';
    }
}