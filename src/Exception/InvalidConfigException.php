<?php

namespace Wangyingqian\AliChat\Exception;

class InvalidConfigException extends AliChatException
{
    /**
     * Bootstrap.
     *
     * @param string       $message
     * @param array|string $raw
     */
    public function __construct($message, $raw = [])
    {
        parent::__construct('INVALID_CONFIG: '.$message, $raw, self::INVALID_CONFIG);
    }
}