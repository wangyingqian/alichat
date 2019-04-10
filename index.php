<?php

require_once 'vendor/autoload.php';

use Wangyingqian\AliChat\AliChat;

AliChat::alipay(['c'=>1])->fund('voucher', ['sss'=>5]);