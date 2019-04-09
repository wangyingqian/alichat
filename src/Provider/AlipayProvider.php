<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\AliChat;
use Wangyingqian\AliChat\Application\Alipay;

class AlipayProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['event'] = function () {
            $aliChat = AliChat::getInstance();
            return new Alipay($aliChat->getConfig());
        };
    }
}