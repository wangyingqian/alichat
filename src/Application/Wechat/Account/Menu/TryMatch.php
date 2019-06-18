<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Menu;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

/**
 * 测试匹配个性化菜单
 *
 * Class TryMatch
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Account\Menu
 */
class TryMatch extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/menu/trymatch';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}