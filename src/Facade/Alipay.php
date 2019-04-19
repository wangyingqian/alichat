<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Support\Facade;

/**
 * Class Alipay
 *
 * @method static verify();
 *
 * @package Wangyingqian\AliChat\Facade
 */
class Alipay extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'alipay';
    }
}