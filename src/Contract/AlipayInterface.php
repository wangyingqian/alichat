<?php
namespace Wangyingqian\AliChat\Contract;

interface AlipayInterface
{
    public function run($params, $method, $gateway);
}