<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\Kernel\Config;

class ConfigProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['config'] = function () {
            return new Config();
        };
    }
}