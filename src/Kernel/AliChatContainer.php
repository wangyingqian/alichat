<?php
namespace Wangyingqian\AliChat\Kernel;

use Wangyingqian\AliChat\Provider\EventProvider;
use Wangyingqian\AliChat\Provider\FundProvider;
use Wangyingqian\AliChat\Provider\LogProvider;
use Wangyingqian\AliChat\Provider\PayProvider;
use Wangyingqian\AliChat\Support\Container;

class AliChatContainer extends Container
{
    /**
     * 服务提供者
     *
     * @var array
     */
    protected $providers = [
        EventProvider::class,
        LogProvider::class,
        PayProvider::class,
        FundProvider::class
    ];

}