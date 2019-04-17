<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 资金授权解冻
 *
 * Class Unfreeze
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Fund
 */
class Unfreeze extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.fund.auth.order.unfreeze';
    }
}
