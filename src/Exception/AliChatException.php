<?php
namespace Wangyingqian\AliChat\Exception;

class AliChatException extends \Exception
{
    const UNKNOWN_ERROR = 9999;

    const INVALID_GATEWAY = 1;

    const INVALID_CONFIG = 2;

    const INVALID_ARGUMENT = 3;

    const INVALID_SIGN = 4;

    const ERROR_GATEWAY = 5;

    const ERROR_BUSINESS = 6;

    /**
     * Raw error info.
     *
     * @var array
     */
    public $raw;

    /**
     * Bootstrap.
     *
     * @param string       $message
     * @param array|string $raw
     * @param int|string   $code
     */
    public function __construct($message = '', $raw = [], $code = self::UNKNOWN_ERROR)
    {
        $message = $message === '' ? 'Unknown Error' : $message;
        $this->raw = is_array($raw) ? $raw : [$raw];

        parent::__construct($message, intval($code));
    }
}