<?php
namespace Wangyingqian\AliChat\Application\Wechat\User;

use Wangyingqian\AliChat\Application\Wechat\Wechat;

class Info extends Wechat
{
    public function __construct()
    {
        $this->method = 'sns/userinfo';
    }
}