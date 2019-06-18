<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Wechat\Account\AccessToken;
use Wangyingqian\AliChat\Application\Wechat\Account\Menu\AddConditional;
use Wangyingqian\AliChat\Application\Wechat\Account\Menu\Create;
use Wangyingqian\AliChat\Application\Wechat\Account\Menu\DelConditional;
use Wangyingqian\AliChat\Application\Wechat\Account\Menu\Delete;
use Wangyingqian\AliChat\Application\Wechat\Account\Menu\Get;
use Wangyingqian\AliChat\Application\Wechat\Account\Menu\SelfInfo;
use Wangyingqian\AliChat\Application\Wechat\Account\Menu\TryMatch;
use Wangyingqian\AliChat\Application\Wechat\Account\Message\KfAdd;
use Wangyingqian\AliChat\Application\Wechat\Account\Message\KfDel;
use Wangyingqian\AliChat\Application\Wechat\Account\Message\KfGet;
use Wangyingqian\AliChat\Application\Wechat\Account\Message\KfSend;
use Wangyingqian\AliChat\Application\Wechat\Account\Message\KfTyping;
use Wangyingqian\AliChat\Application\Wechat\Account\Message\KfUpdate;
use Wangyingqian\AliChat\Application\Wechat\Account\Message\TempUpdate;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class WechatAccount
 *
 * @method static AccessToken access_token(array $params) 获取access_token
 *
 * @method static Create _menu_create(array $params) 创建自定义菜单
 * @method static Get _menu_get(array $params) 获取自定义菜单
 * @method static Delete _menu_delete(array $params) 删除自定义菜单
 * @method static SelfInfo _menu_self_info(array $params) 获取自定义菜单配置
 * @method static AddConditional _menu_add_conditional(array $params) 创建个性化菜单
 * @method static DelConditional _menu_del_conditional(array $params) 删除个性化菜单
 * @method static TryMatch _menu_try_match(array $params) 测试匹配个性化菜单
 *
 * @method static KfAdd _message_kf_add(array $params) 增加客服
 * @method static KfDel _message_kf_del(array $params) 删除客服
 * @method static KfGet _message_kf_get(array $params) 获取客服
 * @method static KfUpdate _message_kf_update(array $params) 更新客服
 * @method static KfSend _message_kf_send(array $params) 客服发送消息
 * @method static KfTyping _message_kf_typing(array $params) 客服输入
 *
 * @method static TempUpdate _media_temp_update(array $params) 新增临时素材
 *
 * @package Wangyingqian\AliChat\Facade
 */
class WechatAccount extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'wechat.account';
    }
}