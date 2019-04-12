<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

class Unfreeze extends Alipay
{
    protected $method = 'alipay.fund.auth.order.unfreeze';
}
