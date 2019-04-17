<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Alipay\Common\Auth;
use Wangyingqian\AliChat\Application\Alipay\Common\Download;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class AlipayCommon
 *
 * @method static Auth auth(array $order)
 * @method static Download download(array $order)
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