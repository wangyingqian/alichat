<?php
namespace Wangyingqian\AliChat\Application\Alipay;

use Wangyingqian\AliChat\Kernel\AliChatContainer;

class Alipay
{
    protected $container;

    protected $request;

    protected $method;

    protected $params;

    public function __invoke(AliChatContainer $container)
    {
        $this->container = $container;

        return $this;
    }

    public function getReturn()
    {
        return [
            'request' => $this->request,
            'method'  => $this->method,
            'params'  => $this->params
        ];
    }
}