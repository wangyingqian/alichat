<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 预授权支付
 *
 * Class PreAuth
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Pay
 */
class PreAuth extends Alipay
{
    protected $method = 'alipay.trade.pay';

    protected $productCode = 'PRE_AUTH';
}