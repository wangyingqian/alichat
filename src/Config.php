<?php

//demo 示例， config文件获取后期优化。可改成通过注册进来

return [

    //阿里配置
    'alipay' => [
        'notify_url' => '',
        'return_url' => '',
        'app_id' =>'2016073000123867',
        'mode' => 'dev',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlWPMgJ7qnarXrgO/r+KpugGeIYwl92n0PPLhNKKK0h5UorYvQNuLnLt2zcIluMW9qabyCRi3thqfM3LHM5st1s8ckgHsfXZ4zeuGDdAxG1qquB8nlyzAJ2QDfHyrWxwJumZhlD+8o5HGdsCgrEalcTSeWm7YrRysV3DJdY2zf6ldb2BbnMPZ6tHGG3kCv6k8X0I6QyPqER0AwrpobB1sQL6iGse8F774C8V4LT4c1S54+PUK3EIVLFQZ8gQxLDZNwO2PpwJ2rCRyH+VfJBcD6II8q9gLUhsmC4RcvU1rG5ev6O45HqF1786F0eVMrcZNE9miQMX0mXGcyIXsi3QWXwIDAQAB',
        'private_key' =>'MIIEowIBAAKCAQEAtBLD1osi+PM0S/I/zYOKUXpxMzUCJ1UfVEZf7Ol0zDwMl4pQCa9lGfUcla2gF3WzMv1AGm/Obfc32SnH693NmjiIyh4K/RZ1JSioF4e1oea6prevuQ0whxD7hsXRzfDtn1MQfClsMSvXqIk2AvwVIdVkkerJMF0ksT5B+SEL3Xe2zdPAkUfvYX2tV1Wok5UwrWGnrQmyNIl55fBw0P8NS2K+mmeA9trjo8Lts10eRstJtNfNOmHlPyw6xDj9IQu11WHqUoDxyFAs+2gaNBkAk8wHC61HIRo6UgXrCw03+nbUgBxyqardD2EfX0tg/it5PMhV/PSCjaAs1WNw9ZkU1QIDAQABAoIBAEh45OiLxt96wilurc8AicKRDM4XH27FC37Xc/PdYWxxHoA+4keDl6UCySZUYoIOlLiIxCvfo60OOiPkdNmwwva2mhb+UF3bk/oIit4teCRYv/YpJ0fKzyUM6K4tH2tK89eTjqbp5OlFQ95ImrxIyBh90aQIYkBcvE+5RsQFUMkon8pniPwrCtpHt5ZiERi+4hrteP2+HK5WR2g2a6AN8SNowd44zt2Lt85un/gDHHYehXmG2ryYh6csC3PPh5IaIsWdT8MD2LcDOR6LvBpccwr4oA4wF8NxhikIr4vZ1be7biA15qfXGETT6Xb1x6Yx6yJGDlW93EXYBJKp+vx3C2ECgYEA5/weEFG2ZkKGNjtMYO6Qc2XTr8Gf8EuFHMrvZViBC7Mw2NG4WKZRqROwiH2AJlrpuqX0I38PlfTB0Azy5lz0u9iGb2gT9BQjdZEnZhJ3Qu2V0lAzI6sJzwEYTQkpww6l7iYyS1cdQtev64NR/zdTS1zesCBhDMlAmlSoYbrB6M8CgYEAxrbto3p2hjJGkZr40uoznC9BXwCyaTHl8r6gQp1IB8sI7T91B1S0MWEwTgHjSsIUEluP11qyoKq9KZJwwvhAZHF7OWEIyoHSVbgB3K5mNhWZQNtPh9LWykC2GC2+ytxGjggxDkO+mKBlg5L+cUR2BXU3Di5zwsGdMzRrG0e1yRsCgYEAt0Y3ei0ULTXhUncGoI3ZEVIhK3mNIgqH33d0Kl0Blny62pDVUzQSz8D+dtavp52rigoSFvkLFy2G8RdJzzUhJEar7tgK64n9eaRzu/BayEVrV/yEaml2FlSHHlVe6Ptpm/wRP/RS6bv8/9N/tGHBLIjyZbMu+SsGHudDH/Krv4ECgYA7OdhYKi7bTm7EBQl2a4FYYqk8NIv4WHvtvq0rTY9jaztM4uXxemh+czYfeeaRqIis9AdKK2kkA99/XXsoUS94AG62qlohaVIUZFSBvqUOJ5/WucbZd5i3DVR4nmHIOqD4wi5EzyImgV/gOFaH0dzPQaFYI7Yy7Nv6n/vwVI400wKBgFW0mSH8Q1Qj7EBdqt8Tb/P6xnlTEGLTWRfBL0MPGUTc0CclX1RhhJY28H5eosEQ/8LdZe2w1yuRPMrOPtXyB9KMnT8qCA/7MCJoQN50r2ote53Xla4NVQGhr516VyxvrMf9QNXtg3Alrn1SxBENxOPBs2RfCa6CtpbQ8F42UqzA',
    ],

    //微信配置
    'wechat' => [
        'mode' => 'dev'
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