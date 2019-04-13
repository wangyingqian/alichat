<?php
namespace Wangyingqian\AliChat\Application\Alipay;


use Wangyingqian\AliChat\Application\AlipayManage;

class Alipay
{
    protected $request;

    protected $method;

    protected $params;

    public function __construct(AlipayManage $alipay)
    {
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