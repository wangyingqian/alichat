<?php
namespace Wangyingqian\AliChat\Application\Alipay\Pay;

use Wangyingqian\AliChat\Application\AlipayManage;
use Wangyingqian\AliChat\Application\Alipay\Alipay;

class Web extends Alipay
{
    protected $method = 'alipay.trade.page.pay';

    protected $productCode = 'FAST_INSTANT_TRADE_PAY';

    protected $request = AlipayManage::PAGE_REQUEST;

}
