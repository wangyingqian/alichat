<?php
namespace Wangyingqian\AliChat\Application\Alipay\Common;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

/**
 * 查询某个应用授权AppAuthToken的授权信息
 *
 * Class OpenTokenQuery
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Common
 */
class OpenTokenQuery extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.open.auth.token.app.query';
    }
}