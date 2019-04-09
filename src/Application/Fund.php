<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Contract\FundInterface;
use Wangyingqian\AliChat\Kernel\Config;

class Fund implements FundInterface
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }
}