<?php
namespace Wangyingqian\AliChat\Application\Alipay\Pay;

use Wangyingqian\AliChat\Contract\PayInterface;
use Wangyingqian\AliChat\Support\Http;

class AppPay extends Pay implements PayInterface
{
    /**
     * app pay
     *
     * @param string $endpoint
     * @param array $payload
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function pay($endpoint, array $payload)
    {
        $payload['method'] = 'alipay.trade.app.pay';
        $payload['biz_content'] = json_encode(array_merge(
            json_decode($payload['biz_content'], true),
            ['product_code' => 'QUICK_MSECURITY_PAY']
        ));
        $payload['sign'] = $this->app->getSign($payload);

        return Http::success(http_build_query($payload));
    }
}