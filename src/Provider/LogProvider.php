<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\Support\Log;

class LogProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['log'] = function ($c) {
            return new Log();
        };
    }
}