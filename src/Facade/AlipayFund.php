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
 * @method static AppFreeze appFreeze(array $order)
 * @method static Cancel cancel(array $order)
 * @method static PosFreeze posFreeze(array $order)
 * @method static Query query(array $order)
 * @method static Unfreeze unfreeze(array $order)
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