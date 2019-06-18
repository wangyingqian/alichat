<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class AccessToken extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/token';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}