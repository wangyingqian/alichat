<?php
namespace Wangyingqian\AliChat\Application\Alipay\Pay;

use Wangyingqian\AliChat\Application\Alipay;

/**
 * @method web(array $config);
 *
 * Class Pay
 *
 * @package Wangyingqian\AliChat\Application\Alipay\Pay
 */
class Pay
{
    protected $app;

    public function __construct(Alipay $app)
    {
        $this->app = $app;
    }

    public function __call($name, $arguments)
    {
        $class = __NAMESPACE__.'\\'.$name;

        return new $class(reset($arguments));
    }

}