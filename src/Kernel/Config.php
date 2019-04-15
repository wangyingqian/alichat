<?php
namespace Wangyingqian\AliChat\Kernel;

use Wangyingqian\AliChat\Support\Collection;

class Config extends Collection
{
    public function __construct()
    {
        $config = require __DIR__.'/../Config.php';

        parent::__construct($config);
    }
}