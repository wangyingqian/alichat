<?php

return [

    //阿里配置
    'alipay' => [
        'notify_url' => '',
        'return_url' => '',
        'app_id' =>'2016073000123867',
        'mode' => 'dev',
        'ali_public_key' => '',
        ],

    //微信配置
    'wechat'=> [
        'app_id' => '',                               // 公众号 APPID
        'miniapp_id' => '',                           // 小程序 APPID
        'sub_appid' => '',                            // 子商户 APP APPID
        'sub_app_id' => '',                           // 子商户 公众号 APPID
        'sub_miniapp_id' => '',                       // 子商户 小程序 APPID
        'mch_id' => '',                               // 商户号
        'sub_mch_id' => '',                           // 子商户商户号-鹏氏水业
        'key' => '',                                  // 主商户 key
        'cert_client' => '',
        'cert_key' => '',
        'mode' => 'dev',
    ],

    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        'verify' =>false,
    ],

    //日志
    'log' => [
    ],
];