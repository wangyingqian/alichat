<?php

require_once 'vendor/autoload.php';


class PayController
{
    protected $config = [
        'app_id' => '2017020505524647',
        'notify_url' => 'http://yansongda.cn/notify.php',
        'return_url' => 'http://yansongda.cn/return.php',
        'ali_public_key' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRAFljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQEB/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5KsiNG9zpgmLCUYuLkxpLQIDAQAB',
        // 加密方式： **RSA2**
        'private_key' =>'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAKuetSZkXpLeiowXwI/CoplIc9Y/FitCPCzs7B301MA3uw6C767WtYh+9/bF3XpadDCgadCEesn6/cakOpUChF3FHYJzAxsiK8S2hG1TIfg/kMM+1cc3XQWl+8MLmzTmgYe5MUb5GMIAGeXfEdUyNCyRzITWMw1sQ7dzsFTMOWE7AgMBAAECgYEAmfuyaZoQyRJnmT8OhW6LWaEKXicIixPIzj5dtJsh8L2QVnrg9yyqgKf7cC0khU13htHHX1Ieoe9Tl9FuxpgVjlzRbi9uBVtdNMhfqT7YS9z8nONDkJ/z7Uw+dIPFWqhKG3q8V/jH1zKUJHDHfoS2+9P6SA4LAHoSVP23h2HbQtECQQDTbMiiMSbxiF7HUvbSmsvWKWy/D+WMHHKvjqNiQ55ketWlBorFMeQjsQZTiM+6UOd2L5Uph1zT4kFYuE7PuXiXAkEAz82IlxlrRawhf2iOD77uZMCAAb5BJ3DBEzsQEOE/Jnd9UXmaDpVpN7mMsTGw+0gJLkoayEkGw/3SBKik1Y7s/QJAGOevmqt/kuQlhgVX3ecuK8QlczxEJgUT3WpIBMNCXUO69v2WSzRdU3b+78gl8CSnn1xrjcDMRolYeUL8xatrcQJATAtsE9dygTGnpIdvjWWSuf4UGg80qqlBjrcLfxHe2UXa72jvrqyQr5rQWLvVh29qJK1rtaW7uxd0ts28XIaMRQJAJ16tCiasM0w7dcXqETbATHNv2gThnfonZSyG0cxn9ADgyTqNM4NzpGL/BV6pyfJY4yWdwPw13BcVPSWbZWWT4g==',
        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];

    public function index()
    {
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject' => 'test subject - 测试',
        ];

        $alipay = \Wangyingqian\AliChat\AliChat::alipay($this->config)->pay('web', $order);

        return $alipay->send();// laravel 框架中请直接 `return $alipay`
    }

    public function return()
    {
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！

        // 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount
    }

    public function notify()
    {
        $alipay = Pay::alipay($this->config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::debug('Alipay notify', $data->all());
        } catch (\Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()`
    }
}

$alipay = new PayController();

$alipay->index();