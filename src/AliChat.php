<?php
namespace Wangyingqian\AliChat;

use Wangyingqian\AliChat\Application\Alipay;
use Wangyingqian\AliChat\Contract\AliChatInterface;
use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;

/**
 * @method static Alipay alipay(array $config) 支付宝
 *
 * Class AliChat
 * @package Wangyingqian\AliChat
 */
class AliChat implements AliChatInterface
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

    /**
     * 配置
     *
     * @var
     */
    protected $config;


    public function __construct($config = [])
    {
        $this->config = new Config($config);

        $this->registerContainer();

        if (empty($this->instance)){
            self::$instance = $this;
        }

    }

    /**
     * 获取配置
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * 获取实例
     *
     * @return AliChat
     */
    public static function getInstance()
    {
        return self::$instance;
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

    public static function __callStatic($name, $config = null)
    {
        new static(reset($config));

        return self::$instance->container[$name];
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