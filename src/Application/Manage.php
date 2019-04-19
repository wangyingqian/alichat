<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Contract\AliChatInterface;
use Wangyingqian\AliChat\Exception\AliChatException;
use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Support\Str;

class Manage implements AliChatInterface
{
    /**
     * 容器
     *
     * @var
     */
    protected $container;

    /**
     * 请求参数
     *
     * @var
     */
    protected $payload;

    public function __construct(AliChatContainer $container)
    {
        $this->container = $container;

        $this->init();
    }

    /**
     * 初始化 子类根据情况复写
     */
    protected function init()
    {
    }

    public function run($params, $method, $gateway)
    {
        return null;
    }

    /**
     * 实例化具体操作对象
     *
     * @param $method
     * @param $gateway
     *
     * @return mixed
     *
     * @throws AliChatException
     */
    public function getGateWay($method, $gateway)
    {
        $class = substr(get_class($this),0, -6).'\\'.Str::studly($gateway .'\\'.$method);

        if (!class_exists($class)){
            throw new AliChatException("class {$class} is not exist");
        }

        $object = new $class();

        return $object($this->container);
    }

    public function __call($name, $arguments)
    {
        list($method, $args) = $arguments;

        return $this->run($args, $method, $name);
    }

}