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
 * @method static Web web(array $order);
 * @method static Wap wap(array $order)
 * @method static Sync sync(array $order)
 * @method static Settle settle(array $order)
 * @method static Scan scan(array $order)
 * @method static RefundQuery refundQuery(array $order)
 * @method static Refund refund(array $order)
 * @method static Query query(array $order)
 * @method static Pos pos(array $order)
 * @method static Face face(array $order)
 * @method static Close close(array $order)
 * @method static Cancel cancel(array $order)
 * @method static App app(array $order)
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