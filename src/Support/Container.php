<?php
namespace Wangyingqian\AliChat\Support;

use Pimple\Container as BaseContainer;

class Container extends BaseContainer
{
    /**
     * 服务提供者
     *
     * @var array
     */
    protected $providers = [];


    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->registerProviders();
    }

    /**
     * 添加提供者
     *
     * @param $provider
     *
     * @return $this
     */
    public function addProvider($provider)
    {
        $this->providers = array_merge($this->providers, $provider);

        return $this;
    }

    /**
     * 设置提供者
     *
     * @param $providers
     */
    public function setProviders($providers)
    {
        $this->providers = [];

        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }
    }

    /**
     * 获取提供者
     *
     * @return array
     */
    public function getProviders()
    {

        return $this->providers;
    }


    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }


    /**
     * 注册提供者
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider);
        }
    }
}