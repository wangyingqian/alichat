<?php
namespace Wangyingqian\AliChat\Application\Wechat;

use Wangyingqian\AliChat\Kernel\AliChatContainer;

class Wechat
{
    protected $container;

    protected $method;

    protected $params;

    protected $tradeType;

    public function __invoke(AliChatContainer $container)
    {
        $this->container = $container;

        return $this;
    }

    public function getReturn()
    {
        return [
            'method'  => $this->method,
            'trade_type' => $this->tradeType,
            'params'  => $this->params
        ];
    }
}