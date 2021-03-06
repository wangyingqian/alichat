<?php
namespace Wangyingqian\AliChat\Application\Alipay\Common;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Application\AlipayManage;

class Download extends Alipay
{
    public function __construct()
    {
        $this->method = 'alipay.data.dataservice.bill.downloadurl.query';
        $this->request = AlipayManage::PAGE_REQUEST;
    }
}