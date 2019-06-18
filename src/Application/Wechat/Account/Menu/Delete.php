<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Menu;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class Delete extends Wechat
{
    public function __construct()
    {
        $this->method  = 'cgi-bin/menu/delete';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}