<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\AliChat;
use Wangyingqian\AliChat\Application\Fund;

class FundProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['fund'] = function (){
            $aliChat = AliChat::getInstance();
            return new Fund($aliChat->getConfig());
        };
    }
}