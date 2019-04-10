<?php

require_once 'vendor/autoload.php';

use Wangyingqian\AliChat\AliChat;

AliChat::alipay(['c'=>13])->fund('voucher', ['sss'=>5]);