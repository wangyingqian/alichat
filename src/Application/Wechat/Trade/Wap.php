<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Symfony\Component\HttpFoundation\Request;
use Wangyingqian\AliChat\Application\Wechat\Wechat;

/**
 * H5 支付
 *
 * Class Scan
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class Wap extends Wechat
{
    public function __construct()
    {
        $this->method = 'pay/unifiedorder';

        $this->tradeType = 'MWEB';

        $this->params = [
            'spbill_create_ip' => Request::createFromGlobals()->getClientIp(),
        ];
    }

    public function handle($data)
    {
        $mWebUrl = $data['mweb_url'];
        $returnUrl = $this->container['config']->get('return_url', null);
        $url = is_null($returnUrl) ? $mWebUrl : $mWebUrl.
            '&redirect_url='.urlencode($returnUrl);

        return $this->container['wechat.request']->redirect($url);
    }
}