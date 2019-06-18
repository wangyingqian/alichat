<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Wechat\User\AccessToken;
use Wangyingqian\AliChat\Application\Wechat\User\Info;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class WechatUser
 *
 * @method static AccessToken access_token(array $order) 换取access_token
 * @method static Info info(array $order) 获取用户信息
 *
 * @package Wangyingqian\AliChat\Facade
 */
class WechatUser extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'wechat.user';
    }
}