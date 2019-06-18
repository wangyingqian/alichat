<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Menu;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class Create extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/menu/create';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}