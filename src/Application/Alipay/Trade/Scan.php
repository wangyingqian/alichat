<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

class Scan extends Alipay
{
    protected $method = 'alipay.trade.precreate';
}