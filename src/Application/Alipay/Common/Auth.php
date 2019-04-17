<?php
namespace Wangyingqian\AliChat\Application\Alipay\Common;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

class Auth extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.user.info.auth';

        $this->request = AlipayManage::PAGE_REQUEST;
    }
}