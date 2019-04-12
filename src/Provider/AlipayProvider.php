<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\AliChat;
use Wangyingqian\AliChat\Application\AlipayManage;
use Wangyingqian\AliChat\Kernel\AlipayRequest;

class AlipayProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['alipay'] = function () {
            $aliChat = AliChat::getInstance();
            return new AlipayManage($aliChat->getConfig(), $aliChat->getContainer());
        };

        $container['alipay.request'] = function ($container){
            return new AlipayRequest($container['alipay']->getConfig());
        };
    }
}