<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Support\Str;

class Manage
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

    /**
     * 配置
     *
     * @var
     */
    protected $config;

    /**
     * get config
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    protected function getGateWay($method, $gateway)
    {
        $class = substr(get_class($this),0, -6).'\\'.Str::studly($gateway .'\\'.$method);

        return new $class($this);
    }
}