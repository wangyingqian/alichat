<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Support\Facade;

/**
 * Class Wechat
 *
 * @method static fromXml(array $params) 把 xml 转换成 array
 * @method static toXml(array $params) 把 array 转换成 xml
 *
 * @package Wangyingqian\AliChat\Facade
 */
class Wechat extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'wechat';
    }
}