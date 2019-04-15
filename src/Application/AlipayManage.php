<?php
namespace Wangyingqian\AliChat\Application;

use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Contract\AlipayInterface;
use Wangyingqian\AliChat\Exception\AliChatException;

class AlipayManage extends Manage implements AlipayInterface
{
    const EXECUTE_REQUEST = 'exe';

    const SDK_REQUEST = 'sdk';

    const PAGE_REQUEST = 'page';

    public function init()
    {
        $this->payload = [
            'app_id'         => $this->container['config']->get('alipay.app_id'),
            'method'         => '',
            'format'         => 'JSON',
            'charset'        => $this->container['config']->get('alipay.charset', 'utf-8'),
            'sign_type'      => $this->container['config']->get('alipay.rsa', 'RSA2'),
            'version'        => '1.0',
            'return_url'     => $this->container['config']->get('alipay.return_url'),
            'notify_url'     => $this->container['config']->get('alipay.notify_url'),
            'timestamp'      => date('Y-m-d H:i:s'),
            'sign'           => '',
            'biz_content'    => '',
            'app_auth_token' => $this->container['config']->get('alipay.app_auth_token'),
        ];
    }

    /**
     * trade
     *
     * @param $method
     * @param array $params
     *
     * @return mixed
     *
     * @throws AliChatException
     */
    public function trade($method, $params = [])
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
    public function fund($method, $params = [])
    {
       return $this->run($params, $method, __FUNCTION__);
    }

    /**
     * common
     *
     * @param $method
     * @param array|null $params
     *
     * @return bool
     *
     * @throws AliChatException
     */
    public function common($method, $params = [])
    {
        return $this->run($params,$method, __FUNCTION__);
    }

    /**
     * request
     *
     * @param $payload
     * @param string $type
     *
     * @return bool
     *
     * @throws AliChatException
     */
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
     * run
     *
     * @param $params
     * @param $method
     * @param $gateway
     *
     * @return bool
     *
     * @throws AliChatException
     */
    protected function run($params, $method, $gateway)
    {
        $this->payload['return_url'] = $params['return_url'] ?? $this->payload['return_url'];
        $this->payload['notify_url'] = $params['notify_url'] ?? $this->payload['notify_url'];

        unset($params['return_url'], $params['notify_url']);
        $this->payload['biz_content'] = json_encode($params);

        $object = $this->getGateWay($method, $gateway);

        if (!is_subclass_of($object, Alipay::class)){
            throw new AliChatException('Object without inheritance');
        }

        $return = $object->getReturn();

        $this->payload['method'] = $return['method'];

        return $this->request($this->payload, $return['request']?:self::EXECUTE_REQUEST);
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
}

