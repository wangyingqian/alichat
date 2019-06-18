<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Menu;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

/**
 * 菜单查询接口
 *
 * Class Get
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Account\Menu
 */
class Get extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/menu/get';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}