<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Alipay\Common\Auth;
use Wangyingqian\AliChat\Application\Alipay\Common\Download;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class AlipayCommon
 *
 * @method static Auth auth(array $order) 用户授权
 * @method static Download download(array $order) 账单下载
 *
 * @package Wangyingqian\AliChat\Facade
 */
class AlipayCommon extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'alipay.common';
    }
}