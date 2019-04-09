<?php
namespace Wangyingqian\AliChat;

use Wangyingqian\AliChat\Contract\AliChatInterface;
use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;

class AliChat implements AliChatInterface
{
    /**
     * 容器
     *
     * @var
     */
    protected $container;

    /**
     * 配置
     *
     * @var
     */
    protected $config;


    public function __construct($config = [])
    {
        $this->config = new Config($config);

        echo 12;
    }



    /**
     * 注册容器
     */
    protected function registerContainer()
    {
        if (!$this->container instanceof AliChatContainer){
            $this->container = new AliChatContainer();
        }
    }
}