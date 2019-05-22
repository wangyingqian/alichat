<?php
namespace Wangyingqian\AliChat\Application\Alipay;

use Wangyingqian\AliChat\Kernel\AliChatContainer;

class Alipay
{
    protected $container;

    /**
     * 请求方式
     *
     * @var
     */
    protected $request;

    /**
     * 请求方法
     *
     * @var
     */

    protected $method;

    /**
     * 请求参数
     *
     * @var
     */
    protected $params;

    /**
     * 请求参数格式
     *
     * @var bool
     */
    protected $format = true;

    public function __invoke(AliChatContainer $container)
    {
        $this->container = $container;

        return $this;
    }

    public function getReturn()
    {
        return [
            'request' => $this->request,
            'method'  => $this->method,
            'params'  => $this->params,
            'format'  => $this->format
        ];
    }
}