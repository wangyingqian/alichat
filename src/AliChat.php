<?php
namespace Wangyingqian\AliChat;

use Wangyingqian\AliChat\Application\AlipayManage;
use Wangyingqian\AliChat\Contract\AliChatInterface;
use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Support\Arr;

/**
 * @method static AlipayManage alipay(array $config) 支付宝
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


    public function __construct($config = [])
    {
        $this->registerContainer();

        $this->container['config']->add($config);

        if (empty($this->instance)){
            self::$instance = $this;
        }

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
     * call
     *
     * @param $name
     * @param array $config
     *
     * @return mixed
     */
    public static function __callStatic($name, $config = [])
    {
        new static(empty($config) ? $config : reset($config));

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