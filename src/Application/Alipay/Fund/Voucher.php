<?php
namespace Wangyingqian\AliChat\Application\Alipay\Fund;

use Wangyingqian\AliChat\Application\App;
use Wangyingqian\AliChat\Support\Ali;
use Wangyingqian\AliChat\Support\Http;

class Voucher extends App
{
    public function __construct($params)
    {
        $this->config = array_filter($params, function ($value) {
            return $value !== '' && !is_null($value);
        });
    }


    public function index()
    {
        $payload = $this->config;
        $biz_array = json_decode($this->config['biz_content'], true);
        $method = $biz_array['http_method'] ?? 'POST';
        $biz_array['product_code'] = $this->getProductCode();
        unset($biz_array['http_method']);

        $payload['method'] = $this->getMethod();
        $payload['biz_content'] = json_encode($biz_array);
        $payload['sign'] = Ali::generateSign($payload);


        return $this->buildPayHtml('https://openapi.alipay.com/gateway.do', $payload, $method);
    }


    protected function buildPayHtml($endpoint, $payload, $method = 'POST')
    {

        if (strtoupper($method) === 'GET') {
            return Http::redirect($endpoint.'?'.http_build_query($payload));
        }

        $sHtml = "<form id='alipay_submit' name='alipay_submit' action='".$endpoint."' method='.$method.'>";
        foreach ($payload as $key => $val) {
            $val = str_replace("'", '&apos;', $val);
            $sHtml .= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }
        $sHtml .= "<input type='submit' value='ok' style='display:none;'></form>";
        $sHtml .= "<script>document.forms['alipay_submit'].submit();</script>";

        return Http::respond($sHtml);
    }

    /**
     * Get method config.
     *
     *
     * @return string
     */
    protected function getMethod()
    {
        return 'alipay.fund.auth.order.app.freeze';
    }

    /**
     * Get productCode config.
     *
     *
     * @return string
     */
    protected function getProductCode(): string
    {
        return 'PRE_AUTH_ONLINE ';
    }
}
