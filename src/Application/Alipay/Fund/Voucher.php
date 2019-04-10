<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\App;

class Voucher extends App
{
    public function __construct($params)
    {
        $this->config = $params;
    }
}