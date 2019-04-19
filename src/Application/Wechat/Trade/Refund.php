<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Wangyingqian\AliChat\Application\Wechat\Wechat;

/**
 * 退款  （需要证书）
 *
 * Class Refund
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class Refund extends Wechat
{
    protected $method = 'secapi/pay/refund';
}