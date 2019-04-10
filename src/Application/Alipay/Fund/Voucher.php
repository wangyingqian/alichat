<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\Base;

class Voucher extends Base
{
    public function __construct($params)
    {
        $this->config = $params;
    }
}