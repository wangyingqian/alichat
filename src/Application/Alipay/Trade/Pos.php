<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 *
 *
 * Class Pos
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Pos extends Alipay
{
    protected $method = 'alipay.trade.pay';
}