<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

class Wap extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.trade.wap.pay';

        $this->request = AlipayManage::PAGE_REQUEST;
    }
}