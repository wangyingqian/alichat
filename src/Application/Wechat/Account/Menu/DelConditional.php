<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Menu;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

/**
 * 删除个性化菜单
 *
 * Class DelConditional
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Account\Menu
 */
class DelConditional extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/menu/delconditional';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}