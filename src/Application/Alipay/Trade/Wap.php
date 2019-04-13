<?php
namespace Wangyingqian\AliChat\Application\Alipay\Trade;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

class Wap extends Alipay
{
    protected $method = 'alipay.trade.wap.pay';

    protected $request = AlipayManage::PAGE_REQUEST;
}