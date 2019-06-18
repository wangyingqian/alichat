<?php
namespace Wangyingqian\AliChat\Application\Alipay\Common;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

/**
 * 换取应用授权令牌
 *
 * Class OpenToken
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Common
 */
class OpenToken extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.open.auth.token.app';
    }
}