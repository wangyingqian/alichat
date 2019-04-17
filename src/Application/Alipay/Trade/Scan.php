<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

class Scan extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.trade.precreate';
    }
}