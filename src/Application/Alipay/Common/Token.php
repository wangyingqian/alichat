<?php
namespace Wangyingqian\AliChat\Application\Alipay\Common;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

/**
 * 换取授权访问令牌
 *
 * Class Token
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Common
 */
class Token extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.system.oauth.token';

        $this->format = false;
    }
}