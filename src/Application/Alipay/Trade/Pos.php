<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * pos
 *
 * Class Pos
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class Pos extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.trade.pay';
    }
}