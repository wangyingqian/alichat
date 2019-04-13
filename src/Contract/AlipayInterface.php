<?php
namespace Wangyingqian\AliChat\Contract;

interface AlipayInterface
{
    public function trade($method, $params = []);

    public function fund($method,  $params = []);

    public function common($method,  $params = []);
}