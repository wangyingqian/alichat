<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Menu;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

/**
 * 获取自定义菜单配置
 *
 * Class SelfInfo
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Account\Menu
 */
class SelfInfo extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/get_current_selfmenu_info';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}