<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\Event;

class EventProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['event'] = function ($c) {
            return new Event();
        };
    }
}