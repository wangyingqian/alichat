<?php
namespace Wangyingqian\AliChat\Application\Alipay\Pay;

use Wangyingqian\AliChat\Application\Alipay;

class Pay
{
    protected $app;

    public function __construct(Alipay $app)
    {
        $this->app = $app;
    }

    public function web($params)
    {
        return new Web($params);
    }
}