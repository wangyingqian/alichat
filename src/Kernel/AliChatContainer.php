<?php
namespace Wangyingqian\AliChat\Kernel;


use Wangyingqian\AliChat\Provider\AlipayProvider;
use Wangyingqian\AliChat\Provider\ConfigProvider;
use Wangyingqian\AliChat\Provider\EventProvider;
use Wangyingqian\AliChat\Provider\LogProvider;
use Wangyingqian\AliChat\Provider\WechatProvider;
use Wangyingqian\AliChat\Support\Container;

class AliChatContainer extends Container
{
    /**
     * 服务提供者
     *
     * @var array
     */
    protected $providers = [
        ConfigProvider::class,
        EventProvider::class,
        LogProvider::class,

        AlipayProvider::class,
        WechatProvider::class
    ];

}