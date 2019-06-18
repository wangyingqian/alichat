<?php
namespace Wangyingqian\AliChat\Application\Alipay\User;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

/**
 * 支付宝会员授权信息查询接口
 *
 * Class Share
 *
 * @package Wangyingqian\AliChat\Application\Alipay\User
 */
class Share extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.user.info.share';

        $this->format  =false;
    }
}