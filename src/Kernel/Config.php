<?php
namespace Wangyingqian\AliChat\Kernel;

use Wangyingqian\AliChat\AliChat;
use Wangyingqian\AliChat\Support\Collection;

class Config extends Collection
{
    public function __construct()
    {
        $config = AliChat::getConfig();

        parent::__construct($config);
    }
}