<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Message;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class KfSend extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/message/custom/send';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}