<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Alipay;
use Wangyingqian\AliChat\Contract\FundInterface;

class Fund implements FundInterface
{
    protected $app;

    public function __construct(Alipay $app = null)
    {
        $this->app = $app;
    }


    public function voucher($params)
    {
        return new Voucher($params);
    }
}