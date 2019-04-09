<?php

require_once 'vendor/autoload.php';

use Wangyingqian\AliChat\AliChat;

AliChat::alipay(['c'=>1])->fund(['c'=>122]);