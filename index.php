<?php

require_once 'vendor/autoload.php';


class PayController
{
    protected $config = [
        'notify_url' => '',
        'return_url' => '',
//                'app_id' =>'2016073000123867',
//        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA7fIURB4YcT2LfWe5yPL17hwKib9CocU8intV9wgYb+0UC7TmCxE0LqzMvZqu+mZ0QH7OQ7POCYlQERHVkvYFOkg1qTceVeNEVwmmpXbm9szbPoxLFLpiAJ4fqibotd3bPdvAs1fD1im3bjJHPu6Z7o/R74wmQrE/R7Oy1kmToFoPBEimBeYRpHSZOqCoIbHRhVterwtlAVOmU/XGzuRVD7DucRUBQfbKOOxLCelT0yPH2g/MpFh0fydcGuFkwrlpNqY4Nu3LDbACDDmZGL93sdMV/44L/7tuvlquEVupv3qpxnLKQs8MPXTNXAdH7LGWUAnU9himszrg7NgNQk5j+wIDAQAB',
//        'private_key' =>'MIIEpAIBAAKCAQEA7fIURB4YcT2LfWe5yPL17hwKib9CocU8intV9wgYb+0UC7TmCxE0LqzMvZqu+mZ0QH7OQ7POCYlQERHVkvYFOkg1qTceVeNEVwmmpXbm9szbPoxLFLpiAJ4fqibotd3bPdvAs1fD1im3bjJHPu6Z7o/R74wmQrE/R7Oy1kmToFoPBEimBeYRpHSZOqCoIbHRhVterwtlAVOmU/XGzuRVD7DucRUBQfbKOOxLCelT0yPH2g/MpFh0fydcGuFkwrlpNqY4Nu3LDbACDDmZGL93sdMV/44L/7tuvlquEVupv3qpxnLKQs8MPXTNXAdH7LGWUAnU9himszrg7NgNQk5j+wIDAQABAoIBACKw/7lqtd+UvIidHd4pZifAGN06cGmLiycZklAA8ycmZpzKVBva90Oy1+rw6YACfgKFOmduiKSlS3IhqoTRr7Nuobw5GAgnqWgTNSO8sTHcbj6xT6UHA5DZfP5ey+DwJq3fIzpCmn/X9zFuzSpkuTap607EnTNuCi7XCUTq10YyczNbVcc5mE32Rh+sb0Cz8hpYvTmBx8JF5GIY4uQCZhnFz6hPi7ZujCUSlaA3QC/JoFm+kTKA6O1hok3GN0qzXBfuiV/hUAFo09tU4JptVNzZ3aIREbuQG91MspN1k81eicuKRjbc8jD6HKeCVuWaSlvHQAEjNMQe4HqApR1Q+skCgYEA+TZpBw2usly9d3FNJyo1Ao/InqnfUzplHQwc5yh7cm72REgSz9ALawX0W4Ba/j6KVZiSf8XXpvyeHy5N4aQR2biw0zfm0rMIhr6PxduwOUA32slrvJRuZb5J0wOGqKW7nVGvyeM9CBuGTIKXmlPmz/FxMkIOdSZE6paRZvc0ypUCgYEA9G0cwd1p/tAnHw4WQjcxtwak5mFPgitOD1KVaTsnDcI/pmEUTdhrbGQc3Q5XetIXtuoYZvaBkXXtvoHgIuJawKy/bTyvQV7WmiMSIQ/WAgW4ot9cpHDZ5bsPi9M7uANCKmGF5RhaLfvuntAxbcd8aJhDft8kliWUPB7koIHcYE8CgYBJyEUiFHfzUKe7lCzeeo2FO6KO7wYycuh6yBpKid66i4WXw6rmIdcvkWy+JmtKOKPmIazF7YIia0o5OxFNy7CJQDgB4NwS53SPyB1y2875tDyVJushwuRIdSUQN0wH5EF+my+rWv63xsZlIojV5R9B017LHWmAX5spxPg5ftj/XQKBgQC45uXPPhjV+07s7jImayx/oVYTNV/5P5swei+uyGG1xdFyopPCg8pX17ACBbxlnBL2e0Z0dVv01vo/mG4e1Y8DnGq/Tx3g3MaJGai4PAuPwhY3l7K0bu5XHFgZVXUiscxW1Sl98hseGCweFa6etj7FvRGqI1HBB7KIfHJFfZdhfwKBgQDU4z2cPw4B0ooFr/z6HyDmFoaxnXS4Z+CLBhqq+gLqLVdsjObAbs+OIsIrAJ0ND3Fm7QTbyg6NkaNqL2FpM8C+cYiCH1/5w2awML94UTmRd39OU0Y0O2RCTgLpvZWM5HSNNev59B5eAYTSWYSmAxpiVdH/askFH17oap8WF8Vt6Q==',

        'app_id' =>'2015120800937921',
        'ali_public_key' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnxj/9qwVfgoUh/y2W89L6BkRAFljhNhgPdyPuBV64bfQNN1PjbCzkIM6qRdKBoLPXmKKMiFYnkd6rAoprih3/PrQEB/VsW8OoM8fxn67UDYuyBTqA23MML9q1+ilIZwBC2AQ2UBVOrFXfFl75p6/B5KsiNG9zpgmLCUYuLkxpLQIDAQAB',
        'private_key' => 'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAKuetSZkXpLeiowXwI/CoplIc9Y/FitCPCzs7B301MA3uw6C767WtYh+9/bF3XpadDCgadCEesn6/cakOpUChF3FHYJzAxsiK8S2hG1TIfg/kMM+1cc3XQWl+8MLmzTmgYe5MUb5GMIAGeXfEdUyNCyRzITWMw1sQ7dzsFTMOWE7AgMBAAECgYEAmfuyaZoQyRJnmT8OhW6LWaEKXicIixPIzj5dtJsh8L2QVnrg9yyqgKf7cC0khU13htHHX1Ieoe9Tl9FuxpgVjlzRbi9uBVtdNMhfqT7YS9z8nONDkJ/z7Uw+dIPFWqhKG3q8V/jH1zKUJHDHfoS2+9P6SA4LAHoSVP23h2HbQtECQQDTbMiiMSbxiF7HUvbSmsvWKWy/D+WMHHKvjqNiQ55ketWlBorFMeQjsQZTiM+6UOd2L5Uph1zT4kFYuE7PuXiXAkEAz82IlxlrRawhf2iOD77uZMCAAb5BJ3DBEzsQEOE/Jnd9UXmaDpVpN7mMsTGw+0gJLkoayEkGw/3SBKik1Y7s/QJAGOevmqt/kuQlhgVX3ecuK8QlczxEJgUT3WpIBMNCXUO69v2WSzRdU3b+78gl8CSnn1xrjcDMRolYeUL8xatrcQJATAtsE9dygTGnpIdvjWWSuf4UGg80qqlBjrcLfxHe2UXa72jvrqyQr5rQWLvVh29qJK1rtaW7uxd0ts28XIaMRQJAJ16tCiasM0w7dcXqETbATHNv2gThnfonZSyG0cxn9ADgyTqNM4NzpGL/BV6pyfJY4yWdwPw13BcVPSWbZWWT4g==',

        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            'verify' =>false,
        ],
        'mode' => 'dev',
    ];

    public function index()
    {
        $order = [
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject' => 'test subject - 测试',
        ];

        $alipay = \Wangyingqian\AliChat\AliChat::alipay($this->config)->pay('web', $order);

        return $alipay->send();
    }

   public function fund()
   {
       $params = [
           'out_order_no' => '518077735255938023',
           'out_request_no' => 'hs518077735255938023',
           'order_title' => '预授权冻结',
           'amount' => '1',
       ];

       $alipay = \Wangyingqian\AliChat\AliChat::alipay($this->config)->fund('voucher', $params);

       return $alipay;

   }
}

$alipay = new PayController();

$alipay->index();