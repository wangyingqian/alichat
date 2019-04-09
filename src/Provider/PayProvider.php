<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\AliChat;
use Wangyingqian\AliChat\Application\Pay;


class PayProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['pay'] = function (){
            $aliChat = AliChat::getInstance();
            return new Pay($aliChat->getConfig());
        };
    }
}