<?php

require_once 'vendor/autoload.php';


class PayController
{
    protected $config = [
        'notify_url' => '',
        'return_url' => '',
//        'app_id' =>'2016073000123867',
//        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtBLD1osi+PM0S/I/zYOKUXpxMzUCJ1UfVEZf7Ol0zDwMl4pQCa9lGfUcla2gF3WzMv1AGm/Obfc32SnH693NmjiIyh4K/RZ1JSioF4e1oea6prevuQ0whxD7hsXRzfDtn1MQfClsMSvXqIk2AvwVIdVkkerJMF0ksT5B+SEL3Xe2zdPAkUfvYX2tV1Wok5UwrWGnrQmyNIl55fBw0P8NS2K+mmeA9trjo8Lts10eRstJtNfNOmHlPyw6xDj9IQu11WHqUoDxyFAs+2gaNBkAk8wHC61HIRo6UgXrCw03+nbUgBxyqardD2EfX0tg/it5PMhV/PSCjaAs1WNw9ZkU1QIDAQAB',
//        'private_key' =>'MIIEowIBAAKCAQEAtBLD1osi+PM0S/I/zYOKUXpxMzUCJ1UfVEZf7Ol0zDwMl4pQCa9lGfUcla2gF3WzMv1AGm/Obfc32SnH693NmjiIyh4K/RZ1JSioF4e1oea6prevuQ0whxD7hsXRzfDtn1MQfClsMSvXqIk2AvwVIdVkkerJMF0ksT5B+SEL3Xe2zdPAkUfvYX2tV1Wok5UwrWGnrQmyNIl55fBw0P8NS2K+mmeA9trjo8Lts10eRstJtNfNOmHlPyw6xDj9IQu11WHqUoDxyFAs+2gaNBkAk8wHC61HIRo6UgXrCw03+nbUgBxyqardD2EfX0tg/it5PMhV/PSCjaAs1WNw9ZkU1QIDAQABAoIBAEh45OiLxt96wilurc8AicKRDM4XH27FC37Xc/PdYWxxHoA+4keDl6UCySZUYoIOlLiIxCvfo60OOiPkdNmwwva2mhb+UF3bk/oIit4teCRYv/YpJ0fKzyUM6K4tH2tK89eTjqbp5OlFQ95ImrxIyBh90aQIYkBcvE+5RsQFUMkon8pniPwrCtpHt5ZiERi+4hrteP2+HK5WR2g2a6AN8SNowd44zt2Lt85un/gDHHYehXmG2ryYh6csC3PPh5IaIsWdT8MD2LcDOR6LvBpccwr4oA4wF8NxhikIr4vZ1be7biA15qfXGETT6Xb1x6Yx6yJGDlW93EXYBJKp+vx3C2ECgYEA5/weEFG2ZkKGNjtMYO6Qc2XTr8Gf8EuFHMrvZViBC7Mw2NG4WKZRqROwiH2AJlrpuqX0I38PlfTB0Azy5lz0u9iGb2gT9BQjdZEnZhJ3Qu2V0lAzI6sJzwEYTQkpww6l7iYyS1cdQtev64NR/zdTS1zesCBhDMlAmlSoYbrB6M8CgYEAxrbto3p2hjJGkZr40uoznC9BXwCyaTHl8r6gQp1IB8sI7T91B1S0MWEwTgHjSsIUEluP11qyoKq9KZJwwvhAZHF7OWEIyoHSVbgB3K5mNhWZQNtPh9LWykC2GC2+ytxGjggxDkO+mKBlg5L+cUR2BXU3Di5zwsGdMzRrG0e1yRsCgYEAt0Y3ei0ULTXhUncGoI3ZEVIhK3mNIgqH33d0Kl0Blny62pDVUzQSz8D+dtavp52rigoSFvkLFy2G8RdJzzUhJEar7tgK64n9eaRzu/BayEVrV/yEaml2FlSHHlVe6Ptpm/wRP/RS6bv8/9N/tGHBLIjyZbMu+SsGHudDH/Krv4ECgYA7OdhYKi7bTm7EBQl2a4FYYqk8NIv4WHvtvq0rTY9jaztM4uXxemh+czYfeeaRqIis9AdKK2kkA99/XXsoUS94AG62qlohaVIUZFSBvqUOJ5/WucbZd5i3DVR4nmHIOqD4wi5EzyImgV/gOFaH0dzPQaFYI7Yy7Nv6n/vwVI400wKBgFW0mSH8Q1Qj7EBdqt8Tb/P6xnlTEGLTWRfBL0MPGUTc0CclX1RhhJY28H5eosEQ/8LdZe2w1yuRPMrOPtXyB9KMnT8qCA/7MCJoQN50r2ote53Xla4NVQGhr516VyxvrMf9QNXtg3Alrn1SxBENxOPBs2RfCa6CtpbQ8F42UqzA',

        'app_id' =>'2015120800937921',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1a2uDjEAo7YQV+18TDsSadShCoYaWI1ik1VIvDRJj5EJ9GUrucqELriuvm07ya13oXV1Mh4optfw45n4Oe6kh6f4YlYB75hSrQeGQuy2SdJv3WTRC8vH4dz53tH2gB9EBWB4CEM18UKEiKSKyqE06tp+9ik4Fi+KYyLNwvzO5VZapl8MoX+oQvGBlsmkdyxoWddYCA+INfVG55Wf2zlpojLSXZRcDK/ywvT16wMDaUBQ7jHo3+c546y8eSbwbcPs3ItCp4IWyxhJCEklJ/zkqp160R26CNRxf2ovjAMLK3bvq5noOO+3u23x6q6jK/A7K7iub1Gbg/b6VJ/GM94d9QIDAQAB',
        'private_key'=>'MIIEpAIBAAKCAQEA1a2uDjEAo7YQV+18TDsSadShCoYaWI1ik1VIvDRJj5EJ9GUrucqELriuvm07ya13oXV1Mh4optfw45n4Oe6kh6f4YlYB75hSrQeGQuy2SdJv3WTRC8vH4dz53tH2gB9EBWB4CEM18UKEiKSKyqE06tp+9ik4Fi+KYyLNwvzO5VZapl8MoX+oQvGBlsmkdyxoWddYCA+INfVG55Wf2zlpojLSXZRcDK/ywvT16wMDaUBQ7jHo3+c546y8eSbwbcPs3ItCp4IWyxhJCEklJ/zkqp160R26CNRxf2ovjAMLK3bvq5noOO+3u23x6q6jK/A7K7iub1Gbg/b6VJ/GM94d9QIDAQABAoIBAQCcPv3RXr+q9kyJHx0O2Psj69k+SsUlD22PcoNXK5zGoDX5Qalxl8aEK4OLt3BKjs+1fqAN38O2DJ0WsNWz9u7US1zy+xU7T9TUtXXVpiW9YWVvLHM3/vDQFbeY2Us4cKRakinzUMI3An7LNBZRCQQa316LPaTHhEfbKe3vsNDRHLfTYYto06bduHO9edHgauuGJeynMSCnZdvyqJF/SwcL3eUkK6ZSn4Oz9sJ7k9cvoN+YEL6ImH19Y30hzIzW5Qhs4MjfHeon2Ec8Qx9KsxvT8ssqXoWl97nGlxCJw7ufX5arsyXCGNM8x2jf5KI8YWIcUbrCpDwJj3IVeYqzQBZZAoGBAO+P6TihYN+nQ7+a5t/1+pN2bx72bZhtYzXeEnEqgYq5sq2pS+65T4RrBtbOTHIVxioLYCdZQdSpBUCxMCOPirX3WNq7xKvLHy7Y7cuYJzWy8exO36NGByCWhd5kr8d4a1DIwq8vEAv4WU5qOLxAQ0gDk+6gyBRUL2e91m9ASO4XAoGBAORXGhy5g7eftdO7AQn10/OLty8uIMc8GtuPkqbrHUViduK4JXSh0dcaaLfnE94CGLp4XKUnF+VMmSHQkP/a7vmJkywqZcUkb3GI4xfChz0PNCgeFNk1KBFLm5hxlqbiThiwFPVAoFF2dkVsBk6B7VcAKi6AhGKrczEqyJy5gsfTAoGABfn+JIaKJypCG26e4el+Fd23ifs14r6f4gEnTqFz1+UoGwMFPPBslm4hHozJBXObnQLppDGq3cZVtjZ1b/2txTplghd7IZoQrheFXzXtjH5pYK7bD3S4ysxWjKTQadaMPtizWrF+4f2RJM6rma60vwAv2Z0zQKaVBC6NQftFloMCgYEAqmt72K546UZw/ZqXluh7jUzcpoDmA+0PGomYaa4WxZ9Mnb/UbK0NoV5bg84aXNrxu9JzSuvXgNLfg4ZXgi3TqDiOuCrYk/+ykWkaHLSaHO9I/RwecVKkGex1L5yvVNSYdwKMUdMvFD223e9W8ac1DXbZBKX0qHPP4IVO/vHR8vMCgYAC7mBx+JJwLA522V/84DB6VWT6rJ4KkMTpGLOm6j8WDdsTLpr9nDetX4/gM+cm22P8/tbwO7kwy+huw5cg3NlF7eZrN4q7gGgXQjXqnxQk5fUBXJlT5276GG1ZWJNEHWpLlCUliZVthGzRKMOMS7h+mpUtgyeGTQOW6dF+vsaxDA==',

        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
            'verify' =>false,
        ],
//        'mode' => 'dev',
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

       return $alipay->send();

   }
}

$alipay = new PayController();

$alipay->index();