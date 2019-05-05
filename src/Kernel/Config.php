<?php
namespace Wangyingqian\AliChat\Kernel;

use Wangyingqian\AliChat\Support\Collection;

class Config extends Collection
{
    protected static $config;

    public function __construct()
    {
        parent::__construct(self::$config);
    }

    public static function setConfig($config)
    {
        self::$config = $config;
    }
}