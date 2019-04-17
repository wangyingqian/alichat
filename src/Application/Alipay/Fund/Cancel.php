<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 资金预授权撤销接
 *
 * Class Cancel
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Fund
 */
class Cancel extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.fund.auth.operation.cancel';
    }
}