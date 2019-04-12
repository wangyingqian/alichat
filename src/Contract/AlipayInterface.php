<?php
namespace Wangyingqian\AliChat\Contract;

interface AlipayInterface
{
    public function pay($method, $params = []);

    public function fund($method, array $params = null);
}