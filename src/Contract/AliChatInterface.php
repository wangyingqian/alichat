<?php
namespace Wangyingqian\AliChat\Contract;

interface AliChatInterface
{
    public function run($gateway,$method);
}