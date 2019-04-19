<?php
namespace Wangyingqian\AliChat\Application;

use Symfony\Component\HttpFoundation\Request;
use Wangyingqian\AliChat\Application\Alipay\Alipay;
use Wangyingqian\AliChat\Exception\AliChatException;
use Wangyingqian\AliChat\Exception\InvalidSignException;

class AlipayManage extends Manage
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
    public function run($params, $method, $gateway)
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

        $this->payload = array_filter($this->payload);

        return $this->request($this->payload, $return['request']?:self::EXECUTE_REQUEST);
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
    protected function request($payload, $type = self::EXECUTE_REQUEST)
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

    public function verify($data = null, $refund = false)
    {
        if (is_null($data)) {
            $request = Request::createFromGlobals();

            $data = $request->request->count() > 0 ? $request->request->all() : $request->query->all();
            $data = $this->container['alipay.request']->encoding($data, 'utf-8', $data['charset'] ?? 'gb2312');
        }

        if (isset($data['fund_bill_list'])) {
            $data['fund_bill_list'] = htmlspecialchars_decode($data['fund_bill_list']);
        }

        if ($this->container['alipay.request']->verifySign($data)) {
            return $data;
        }

        throw new InvalidSignException('Alipay Sign Verify FAILED', $data);
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

