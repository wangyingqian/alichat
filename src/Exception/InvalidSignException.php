<?php

namespace Wangyingqian\AliChat\Exception;

class InvalidSignException extends AliChatException
{
    /**
     * Bootstrap.
     *
     * @param string       $message
     * @param array|string $raw
     */
    public function __construct($message, $raw = [])
    {
        parent::__construct('INVALID_SIGN: '.$message, $raw, self::INVALID_SIGN);
    }
}