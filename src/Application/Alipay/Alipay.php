<?php
namespace Wangyingqian\AliChat\Application\Alipay;


use Wangyingqian\AliChat\Application\AlipayManage;

class Alipay
{
    protected $request;

    protected $method;

    protected $productCode;

    public function __construct(AlipayManage $alipay)
    {

    }

    public function getReturn()
    {
        return [
            'request'       => $this->request,
            'method'        => $this->method,
            'product_code'  => $this->productCode
        ];
    }
}