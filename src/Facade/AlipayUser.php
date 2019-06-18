<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Alipay\User\Share;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class AlipayUser
 *
 * @method static Share share(array $order)会员授权信息查询
 *
 * @package Wangyingqian\AliChat\Facade
 */
class AlipayUser extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'alipay.user';
    }
}