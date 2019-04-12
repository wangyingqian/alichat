<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Contract\AlipayInterface;
use Wangyingqian\AliChat\Exception\AliChatException;
use Wangyingqian\AliChat\Exception\InvalidSignException;
use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Support\Collection;
use Wangyingqian\AliChat\Support\Http;


class AlipayManage extends Manage implements AlipayInterface
{
    const EXECUTE_REQUEST = 'exe';

    const SDK_REQUEST = 'sdk';

    const PAGE_REQUEST = 'page';

    public function __construct(Config $config, AliChatContainer $container)
    {
        $this->container = $container;

        $this->config = $config;

        $this->payload = [
            'app_id'         => $config->get('app_id'),
            'method'         => '',
            'format'         => 'JSON',
            'charset'        => $config->get('charset', 'utf-8'),
            'sign_type'      => $config->get('rsa', 'RSA2'),
            'version'        => '1.0',
            'return_url'     => $config->get('return_url'),
            'notify_url'     => $config->get('notify_url'),
            'timestamp'      => date('Y-m-d H:i:s'),
            'sign'           => '',
            'biz_content'    => '',
            'app_auth_token' => $config->get('app_auth_token'),
        ];
    }

    /**
     * pay
     *
     * @param $method
     * @param array $params
     *
     * @return mixed
     *
     * @throws AliChatException
     */
    public function pay($method, $params = [])
    {
        return $this->run($params, $method, __FUNCTION__);

    }

    /**
     * fund
     *
     * @param $method
     * @param array|null $params
     *
     * @return mixed
     *
     * @throws AliChatException
     */
    public function fund($method, array $params = null)
    {
       return $this->run($params,$method, __FUNCTION__);
    }


    protected function request($payload, $type = 'page')
    {
        $payload['sign'] = $this->getSign($payload);

        if (!in_array($type, [self::EXECUTE_REQUEST, self::PAGE_REQUEST, self::SDK_REQUEST])){
            throw new AliChatException('request tpye error');
        }

        switch ($type){
            case self::EXECUTE_REQUEST:
                return $this->container['alipay.request']->apiRequest($payload);
            case self::PAGE_REQUEST:
                return $this->container['alipay.request']->pageRequest($payload);
            case self::SDK_REQUEST:
                return $this->container['alipay.request']->sdkRequest($payload);
        }

        return true;
    }

    /**
     * sign
     *
     * @param $payload
     *
     * @return mixed
     */
    protected function getSign($payload)
    {
        return $this->container['alipay.request']->generateSign($payload);
    }

    protected function run($params, $method, $gateway)
    {
        $this->payload['return_url'] = $params['return_url'] ?? $this->payload['return_url'];
        $this->payload['notify_url'] = $params['notify_url'] ?? $this->payload['notify_url'];

        unset($params['return_url'], $params['notify_url']);

        $this->payload['biz_content'] = $params;

        $object = $object = $this->getGateWay($method, $gateway);

        if (!is_subclass_of($object, Alipay::class)){
            throw new AliChatException('Object without inheritance');
        }

        $return = $object->getReturn();

        if (!empty($return['product_code'])){
            $params['product_code'] = $return['product_code'];
        }

        $this->payload['biz_content'] = json_encode($params);
        $this->payload['method'] = $return['method'];

        return $this->request($this->payload, $return['request']?:self::EXECUTE_REQUEST);
    }
}

