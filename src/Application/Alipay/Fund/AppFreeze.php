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
class AppFreeze extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.fund.auth.order.app.freeze';

        $this->request = AlipayManage::SDK_REQUEST;

        $this->params = [
            'product_code'=>'PRE_AUTH_ONLINE'
        ];
    }
}