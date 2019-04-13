<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 资金授权撤销
 *
 * Class Cancel
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Fund
 */
class Cancel extends Alipay
{
    protected $method = 'alipay.fund.auth.operation.cancel';
}