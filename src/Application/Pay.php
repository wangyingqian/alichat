<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Contract\PayInterface;
use Wangyingqian\AliChat\Kernel\Config;

class Pay implements PayInterface
{
    protected $config;

    public function __construct(Config $config = null)
    {
        $this->config = $config;

    }
}