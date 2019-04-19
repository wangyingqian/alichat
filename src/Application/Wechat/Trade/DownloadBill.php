<?php
namespace Wangyingqian\AliChat\Application\Wechat\Trade;

use Wangyingqian\AliChat\Application\Wechat\Wechat;

/**
 * 下载对账单
 *
 * Class DownloadBill
 *
 * @package Wangyingqian\AliChat\Application\Wechat\Trade
 */
class DownloadBill extends Wechat
{
    protected $method = 'pay/downloadbill';
}