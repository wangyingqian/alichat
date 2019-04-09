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
        $container['alipay'] = function () {
            $aliChat = AliChat::getInstance();
            return new Alipay($aliChat->getConfig(), $aliChat->getContainer());
        };

        $container['alipay.pay'] = function ($container) {
            return new Alipay\Pay\Pay($container['alipay']);
        };

        $container['alipay.fund'] = function ($container) {
            return new Alipay\Fund\Fund($container['alipay']);
        };
    }
}