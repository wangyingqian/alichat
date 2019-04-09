<?php
namespace Wangyingqian\AliChat\BaseListener;

use Symfony\Component\EventDispatcher\EventDispatcher;

abstract class BaseListener
{
    protected $listener = [];

    protected $dispatch;

    public function __construct(EventDispatcher $dispatch)
    {
        $this->dispatch = $dispatch;
    }

    abstract function addListener();
}