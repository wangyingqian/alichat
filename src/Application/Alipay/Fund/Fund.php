<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay;

class Fund
{
    protected $app;

    public function __construct(Alipay $app = null)
    {
        $this->app = $app;
    }

    public function driver($params)
    {
        var_dump($params);die;
    }
}