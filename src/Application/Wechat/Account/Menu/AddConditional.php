<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Menu;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

/**
 * 新增个性化菜单
 *
 * Class AddConditional
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Account\Menu
 */
class AddConditional extends Wechat
{
     public function __construct()
     {
         $this->method = 'cgi-bin/menu/addconditional';

         $this->request = WechatManage::ACCOUNT_REQUEST;
     }
}