<?php
namespace Wangyingqian\AliChat\Application\Wechat;

class Wechat
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