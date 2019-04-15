<?php
namespace Wangyingqian\AliChat;

use Wangyingqian\AliChat\Application\AlipayManage;
use Wangyingqian\AliChat\Kernel\AliChatContainer;

/**
 * @method static AlipayManage alipay() 支付宝
 *
 * Class AliChat
 * @package Wangyingqian\AliChat
 */
class AliChat
{
    /**
     * 单例
     *
     * @var AliChat
     */
    protected static $instance;

    /**
     * 容器
     *
     * @var
     */
    protected $container;


    public function __construct()
    {
        $this->registerContainer();

        if (empty($this->instance)){
            self::$instance = $this;
        }
    }

    /**
     * call
     *
     * @param $name
     * @param array $config
     *
     * @return mixed
     */
    public static function __callStatic($name, $config = null)
    {
        new self();

        return self::$instance->container[$name];
    }

    /**
     * 获取容器
     *
     * @return mixed
     */
    public function getContainer()
    {
        return $this->container;
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