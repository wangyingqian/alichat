<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

/**
 * 线上资金授权冻结
 *
 * Class Freeze
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Fund
 */
class Freeze extends Alipay
{
    protected $method = 'alipay.fund.auth.order.app.freeze';

    protected $request = AlipayManage::SDK_REQUEST;

    protected $productCode = 'PRE_AUTH_ONLINE';
}