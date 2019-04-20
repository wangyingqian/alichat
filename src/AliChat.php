<?php
namespace Wangyingqian\AliChat;


/**
 * Class AliChat
 *
 * @package Wangyingqian\AliChat
 */
class AliChat
{
    protected static $config;

    public static function boot($config)
    {
        self::$config = $config;
    }

    public static function getConfig()
    {
        return self::$config;
    }
}