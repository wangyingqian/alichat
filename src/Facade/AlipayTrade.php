<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Alipay\Trade\Web;
use Wangyingqian\AliChat\Support\Facade;

/**
 * @method static Web web(array $order);
 *
 * Class Alipay
 *
 * @package Wangyingqian\AliChat\Facade
 */
class AlipayTrade extends Facade
{
    /**
     *
     * @return string|void
     */
    public static function getFacadeAccessor()
    {
        return 'alipay.trade';
    }
}