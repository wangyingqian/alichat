<?php
namespace Wangyingqian\AliChat;

use Wangyingqian\AliChat\Application\Alipay;
use Wangyingqian\AliChat\Contract\AliChatInterface;
use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;

/**
 * @method static Alipay alipay(array $config) 支付宝
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


    public function __call($name, $config = null)
    {
        new self(reset($config));

        return call_user_func_array([self::class, 'make'], [$name]);
    }

    public static function __callStatic($name, $config = null)
    {
        new static(reset($config));

        return call_user_func_array([static::class, 'make'], [$name]);
    }

    /**
     * 获取
     *
     * @param $name
     *
     * @return mixed
     */
    protected function make($name)
    {
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