<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\Application\WechatManage;
use Wangyingqian\AliChat\Kernel\WechatRequest;


class WechatProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['wechat'] = function ($container) {
            return new WechatManage($container);
        };
        $container['wechat.request'] = function ($container) {
            return new WechatRequest($container['config']);
        };
    }
}