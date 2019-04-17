<?php
namespace Wangyingqian\AliChat\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Wangyingqian\AliChat\Support\Log;

class LogProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        if (!empty($container['config']->get('log'))){
            $logger = Log::createLogger(
                $container['config']->get('log.file'),
                '',
                $container['config']->get('log.level', 'debug'),
                $container['config']->get('log.type', 'daily'),
                $container['config']->get('log.max_file', 30)
            );

            Log::setLogger($logger);
        }
    }
}