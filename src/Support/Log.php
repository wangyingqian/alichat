<?php
namespace Wangyingqian\AliChat\Support;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * @method static void emergency($message, array $context = array())
 * @method static void alert($message, array $context = array())
 * @method static void critical($message, array $context = array())
 * @method static void error($message, array $context = array())
 * @method static void warning($message, array $context = array())
 * @method static void notice($message, array $context = array())
 * @method static void info($message, array $context = array())
 * @method static void debug($message, array $context = array())
 * @method static void log($message, array $context = array())
 */
class Log
{
    /**
     * Logger instance.
     *
     * @var LoggerInterface
     */
    protected static $logger;

    /**
     * Forward call.
     *
     * @param string $method
     * @param array  $args
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        return forward_static_call_array([self::getLogger(), $method], $args);
    }

    /**
     * Forward call.
     *
     * @param string $method
     * @param array  $args
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([self::getLogger(), $method], $args);
    }

    /**
     * Return the logger instance.
     *
     * @throws \Exception
     *
     * @return LoggerInterface
     */
    public static function getLogger()
    {
        return self::$logger ?: self::$logger = self::createLogger();
    }

    /**
     * Set logger.
     *
     * @param LoggerInterface $logger
     */
    public static function setLogger(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }

    /**
     * Tests if logger exists.
     *
     * @return bool
     */
    public static function hasLogger()
    {
        return self::$logger ? true : false;
    }

    /**
     * Make a default log instance.
     *
     * @param string     $file
     * @param string     $identify
     * @param int|string $level
     * @param string     $type
     * @param int        $max_files
     *
     * @throws \Exception
     *
     * @return \Monolog\Logger
     */
    public static function createLogger($file = null, $identify = 'alichat', $level = Logger::DEBUG, $type = 'daily', $max_files = 30)
    {

        $file = is_null($file) ? './logs/'.$identify.'.php': $file;

        $handler = $type === 'single' ? new StreamHandler($file, $level) : new RotatingFileHandler($file, $max_files, $level);

        $handler->setFormatter(
            new LineFormatter("%datetime% > %channel%.%level_name% > %message% %context% %extra%\n\n", null, false, true)
        );

        $logger = new Logger($identify);
        $logger->pushHandler($handler);

        return $logger;
    }
}