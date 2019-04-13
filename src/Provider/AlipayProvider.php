<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\Application\AlipayManage;
use Wangyingqian\AliChat\Kernel\AlipayRequest;

class AlipayProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['alipay'] = function ($container) {
            return new AlipayManage($container);
        };

        $container['alipay.request'] = function ($container){
            return new AlipayRequest($container['config']);
        };
    }
}