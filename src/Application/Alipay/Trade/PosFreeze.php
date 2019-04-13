<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 资金授权冻结
 *
 * Class Freeze
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Trade
 */
class PosFreeze extends Alipay
{
    protected $method = 'alipay.fund.auth.order.freeze';
}