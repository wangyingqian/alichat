<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Message;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class KfAdd extends Wechat
{
    public function __construct()
    {
        $this->method = 'customservice/kfaccount/add';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}