<?php
namespace Wangyingqian\AliChat\Support;

use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;

class Facade
{
    protected static $container;

    public function __construct($arg)
    {
        Config::setConfig($arg);

        self::$container = new AliChatContainer();
    }


    public static function getFacadeAccessor()
    {
        return null;
    }

    public static function __callStatic($method,$arg)
    {
        return self::getInstance($method, $arg);
    }

    protected static function getInstance($classname, $arg)
    {
        new self(...$arg);

        $facade =  static::getFacadeAccessor();

        if (stripos($facade, '.') !== false){
            list($class, $method) = explode('.',$facade);
            return self::$container[$class]->$method($classname);
        }else{
            return self::$container[$facade]->$classname();
        }
    }

}