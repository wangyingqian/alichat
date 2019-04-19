<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Wangyingqian\AliChat\Application\Wechat\Wechat;

/**
 * 关闭订单
 *
 * Class Close
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class Close extends Wechat
{
    public function __construct()
    {
        $this->method = 'pay/closeorder';
    }
}