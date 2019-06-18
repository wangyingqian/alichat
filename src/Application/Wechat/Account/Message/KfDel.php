<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Message;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class KfDel extends Wechat
{
    public function __construct()
    {
        $this->method = 'customservice/kfaccount/del';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}