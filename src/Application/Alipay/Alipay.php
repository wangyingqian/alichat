<?php
namespace Wangyingqian\AliChat\Application\Alipay;

class Alipay
{
    protected $request;

    protected $method;

    protected $params;

    public function getReturn()
    {
        return [
            'request' => $this->request,
            'method'  => $this->method,
            'params'  => $this->params
        ];
    }
}