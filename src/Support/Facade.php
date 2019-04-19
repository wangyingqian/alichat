<?php
namespace Wangyingqian\AliChat\Support;

use Wangyingqian\AliChat\Kernel\AliChatContainer;

class Facade
{
    protected static $container;

    public function __construct()
    {
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
        new self();

        $facade =  static::getFacadeAccessor();

        if (stripos($facade, '.') !== false){
            list($class, $method) = explode('.',$facade);
            return self::$container[$class]->$method($classname, ...$arg);
        }else{
            return self::$container[$facade]->$classname(...$arg);
        }
    }

}