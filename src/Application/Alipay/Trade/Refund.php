<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

class Refund extends Alipay
{
    protected $method = 'alipay.trade.refund';
}