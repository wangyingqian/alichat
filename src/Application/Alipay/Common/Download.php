<?php
namespace Wangyingqian\AliChat\Application\Alipay\Common;

use Wangyingqian\AliChat\Application\Alipay\Alipay;

class Download extends Alipay
{
    protected $method = 'alipay.data.dataservice.bill.downloadurl.query';
}