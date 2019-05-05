<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Alipay\Trade\App;
use Wangyingqian\AliChat\Application\Alipay\Trade\Cancel;
use Wangyingqian\AliChat\Application\Alipay\Trade\Close;
use Wangyingqian\AliChat\Application\Alipay\Trade\Face;
use Wangyingqian\AliChat\Application\Alipay\Trade\Pos;
use Wangyingqian\AliChat\Application\Alipay\Trade\Query;
use Wangyingqian\AliChat\Application\Alipay\Trade\Refund;
use Wangyingqian\AliChat\Application\Alipay\Trade\RefundQuery;
use Wangyingqian\AliChat\Application\Alipay\Trade\Scan;
use Wangyingqian\AliChat\Application\Alipay\Trade\Settle;
use Wangyingqian\AliChat\Application\Alipay\Trade\Sync;
use Wangyingqian\AliChat\Application\Alipay\Trade\Wap;
use Wangyingqian\AliChat\Application\Alipay\Trade\Web;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class Alipay
 *
 * @method static Web web(array $order); 网页支付
 * @method static Wap wap(array $order) 手机h5支付
 * @method static Sync sync(array $order) 线下订单同步
 * @method static Settle settle(array $order) 线下结算
 * @method static Scan scan(array $order) 扫码支付
 * @method static RefundQuery refund_query(array $order) 退款查询
 * @method static Refund refund(array $order) 退款
 * @method static Query query(array $order) 查询
 * @method static Pos pos(array $order) 付款码
 * @method static Face face(array $order) 当面付
 * @method static Close close(array $order) 关闭交易
 * @method static Cancel cancel(array $order) 取消交易
 * @method static App app(array $order) app 支付
 *
 * @package Wangyingqian\AliChat\Facade
 */
class AlipayTrade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'alipay.trade';
    }
}