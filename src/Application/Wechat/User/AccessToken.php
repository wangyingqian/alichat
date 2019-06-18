<?php
namespace Wangyingqian\AliChat\Application\Wechat\User;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

/**
 * 获取access token
 *
 * Class AccessToken
 *
 * @package Wangyingqian\AliChat\Application\Wechat\User
 */
class AccessToken extends Wechat
{
    public function __construct()
    {
        $this->method = 'sns/oauth2/access_token';
        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}