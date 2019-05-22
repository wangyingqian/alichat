<?php
namespace Wangyingqian\AliChat\Facade;

use Wangyingqian\AliChat\Application\Alipay\Common\Auth;
use Wangyingqian\AliChat\Application\Alipay\Common\Download;
use Wangyingqian\AliChat\Application\Alipay\Common\OpenToken;
use Wangyingqian\AliChat\Application\Alipay\Common\OpenTokenQuery;
use Wangyingqian\AliChat\Application\Alipay\Common\Token;
use Wangyingqian\AliChat\Support\Facade;

/**
 * Class AlipayCommon
 *
 * @method static Auth auth(array $order) 用户授权
 * @method static Download download(array $order) 账单下载
 * @method static Token token(array $order) 换取授权访问令牌
 * @method static OpenToken open_token(array $order) 换取应用授权令牌
 * @method static OpenTokenQuery open_token_query(array $order) 查询应用授权令牌
 *
 *
 * @package Wangyingqian\AliChat\Facade
 */
class AlipayCommon extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'alipay.common';
    }
}