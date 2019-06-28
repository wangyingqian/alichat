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
            'app_id'         => '',
            'method'         => '',
            'format'         => 'JSON',
            'charset'        => 'utf-8',
            'sign_type'      => 'RSA2',
            'version'        => '1.0',
            'timestamp'      => date('Y-m-d H:i:s'),
            'sign'           => '',
            'biz_content'    => '',
            'app_auth_token' => '',
        ];
    }

    /**
     * run
     *
     * @param $name
     * @param $method
     *
     * @return bool|null
     *
     * @throws AliChatException
     */
    public function run($name, $method)
    {

        $object = $this->getGateWay($method, $name);

        if (!is_subclass_of($object, Alipay::class)){
            throw new AliChatException('Object without inheritance');
        }

        $return = $object->getReturn();

        $this->payload['method'] = $return['method'];

        $this->parseParams($return['params'] ?? [], $return['format']);

        $this->payload['sign'] = $this->getSign(array_filter($this->payload));

        return $this->request(array_filter($this->payload), $return['request']?:self::EXECUTE_REQUEST);
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

    public function decrypt($encryptedData, $aesKey)
    {
        $arrayEncryptedData = json_decode($encryptedData, true);

        if (!isset($arrayEncryptedData['response'])){
            return $encryptedData;
        }

        $respond = $arrayEncryptedData['response'];

        $aesKey=base64_decode($aesKey);

        $iv = 0;

        $aesIV=base64_decode($iv);

        $aesCipher=base64_decode($respond);

        $arrayEncryptedData['response'] =json_decode( openssl_decrypt($aesCipher, "AES-128-CBC", $aesKey, OPENSSL_RAW_DATA, $aesIV), true);

        return $arrayEncryptedData;
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

    /**
     * 处理参数
     *
     * @param $params
     * @param $format
     */
    protected function parseParams($params, $format)
    {
        $ignoreParams = [
            'ali_public_key',
            'private_key',
            'http',
            'log',
            'mode'
        ];

        $convertParams = [
            'app_id',
            'method',
            'format',
            'charset',
            'sign_type',
            'version',
            'return_url',
            'notify_url',
            'timestamp',
            'sign',
            'biz_content',
            'app_auth_token',
        ];

        $params = array_merge($this->container['config']->all(), $params);

        foreach ($params as $k =>$v){
            if (in_array($k, $ignoreParams)) {
                unset($params[$k]);
            };
            if (in_array($k, $convertParams)){
                $this->payload[$k] = $v;
                unset($params[$k]);
            }
        }

        if ($format){
            $this->payload['biz_content'] = json_encode($params);
        }else{
            $this->payload = array_merge($this->payload, $params);
        }

    }

}

