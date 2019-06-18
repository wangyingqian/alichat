<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Message;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class KfGet extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/customservice/getkflist';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}