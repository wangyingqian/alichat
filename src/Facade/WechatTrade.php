<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Wechat\Trade\Account;
use Wangyingqian\AliChat\Application\Wechat\Trade\App;
use Wangyingqian\AliChat\Application\Wechat\Trade\Close;
use Wangyingqian\AliChat\Application\Wechat\Trade\DownloadBill;
use Wangyingqian\AliChat\Application\Wechat\Trade\Mini;
use Wangyingqian\AliChat\Application\Wechat\Trade\Query;
use Wangyingqian\AliChat\Application\Wechat\Trade\Refund;
use Wangyingqian\AliChat\Application\Wechat\Trade\RefundQuery;
use Wangyingqian\AliChat\Application\Wechat\Trade\Scan;
use Wangyingqian\AliChat\Support\Facade;

/**
 * wechatTrade facade
 *
 * Class WechatTrade
 *
 * @method static Scan scan(array $params) 扫码支付
 * @method static App app(array $params) app 支付
 * @method static Account account(array $params) 公众号支付
 * @method static Mini mini(array $params) 小程序支付
 * @method static Query query(array $params) 查询
 * @method static Refund refund(array $params) 退款
 * @method static RefundQuery refund_query(array $params) 退款查询
 * @method static Close close(array $params) 关闭交易
 * @method static DownloadBill download_bill(array $params) 下载账单
 *
 * @package Wangyingqian\AliChat\Facade
 */
class WechatTrade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'wechat.trade';
    }
}