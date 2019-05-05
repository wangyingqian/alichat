<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Alipay\Fund\AppFreeze;
use Wangyingqian\AliChat\Application\Alipay\Fund\Cancel;
use Wangyingqian\AliChat\Application\Alipay\Fund\PosFreeze;
use Wangyingqian\AliChat\Application\Alipay\Fund\Query;
use Wangyingqian\AliChat\Application\Alipay\Fund\Unfreeze;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class AlipayFund
 *
 * @method static AppFreeze app_freeze(array $order) 线上冻结资金
 * @method static Cancel cancel(array $order) 资金授权撤销
 * @method static PosFreeze pos_freeze(array $order) 扫码冻结资金
 * @method static Query query(array $order) 资金授权操作查询
 * @method static Unfreeze unfreeze(array $order) 解冻资金
 *
 * @package Wangyingqian\AliChat\Facade
 */
class AlipayFund extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'alipay.fund';
    }
}