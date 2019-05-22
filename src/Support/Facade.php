<?php
namespace Wangyingqian\AliChat\Support;

use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;

class Facade
{
    protected static $container;

    public function __construct($arg = null)
    {
        if (is_array($arg)){
            Config::setConfig($arg);
        }

        self::$container = new AliChatContainer();
    }
    
    public static function getFacadeAccessor()
    {
        return null;
    }

    public static function __callStatic($method,$arg)
    {
        new self(...$arg);

        return self::getInstance($method, ...$arg);
    }

    protected static function getInstance($classname, $arg)
    {
        $facade =  static::getFacadeAccessor();

        if (stripos($facade, '.') !== false){
            list($class, $method) = explode('.',$facade, 2);
            return self::$container[$class]->$method($classname);
        }else{
            return self::$container[$facade]->$classname($arg);
        }
    }

}