<?php
namespace Wangyingqian\AliChat\Application;

use Prophecy\Exception\Doubler\MethodNotFoundException;
use Wangyingqian\AliChat\Contract\AlipayInterface;
use Wangyingqian\AliChat\Contract\PayInterface;
use Wangyingqian\AliChat\Exception\InvalidSignException;
use Wangyingqian\AliChat\Exception\RequestException;
use Wangyingqian\AliChat\Kernel\AliChatContainer;
use Wangyingqian\AliChat\Kernel\Config;
use Wangyingqian\AliChat\Support\Ali;
use Wangyingqian\AliChat\Support\Collection;
use Wangyingqian\AliChat\Support\Http;
use Wangyingqian\AliChat\Support\Log;
use Wangyingqian\AliChat\Support\Str;

class Alipay implements AlipayInterface
{
    /**
     * Const mode_normal.
     */
    const MODE_NORMAL = 'normal';

    /**
     * Const mode_dev.
     */
    const MODE_DEV = 'dev';

    /**
     * Const url.
     */
    const URL = [
        self::MODE_NORMAL => 'https://openapi.alipay.com/gateway.do',
        self::MODE_DEV    => 'https://openapi.alipaydev.com/gateway.do',
    ];

    /**
     * 容器
     *
     * @var
     */
    protected $container;

    /**
     * Alipay payload.
     *
     * @var array
     */
    protected $payload;

    /**
     * @var string
     */
    protected $baseUri;

    protected $config;


    public function __construct(Config $config, AliChatContainer $container)
    {
        $this->container = $container;

        $this->baseUri = Ali::create($config)->getBaseUri();
        $this->payload = [
            'app_id'         => $config->get('app_id'),
            'method'         => '',
            'format'         => 'JSON',
            'charset'        => 'utf-8',
            'sign_type'      => 'RSA2',
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
     * @param $type
     * @param array $params
     * @return mixed
     *
     * @throws RequestException
     */
    public function pay($type, $params = [])
    {
        $this->payload['return_url'] = $params['return_url'] ?? $this->payload['return_url'];
        $this->payload['notify_url'] = $params['notify_url'] ?? $this->payload['notify_url'];

        unset($params['return_url'], $params['notify_url']);

        $this->payload['biz_content'] = json_encode($params);

        $type = $this->getType($type.'Pay');

        if (class_exists($type)) {
            $app = new $type();

            if ($app instanceof PayInterface) {
                return $app->pay($this->baseUri, array_filter($this->payload, function ($value) {
                    return $value !== '' && !is_null($value);
                }));
            }

            throw new RequestException("Pay type [{$type}] Must Be An Instance Of PayInterface");
        }

        throw new RequestException("Pay type [{$type}] not exists");
    }

    /**
     * verify sign
     *
     * @param null $data
     * @param bool $refund
     * @return Collection
     * @throws InvalidSignException
     *
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function verify($data = null, $refund = false)
    {
        if (is_null($data)) {
            $request = Http::createFromGlobals();

            $data = $request->request->count() > 0 ? $request->request->all() : $request->query->all();
            $data = Ali::encoding($data, 'utf-8', $data['charset'] ?? 'gb2312');
        }

        if (isset($data['fund_bill_list'])) {
            $data['fund_bill_list'] = htmlspecialchars_decode($data['fund_bill_list']);
        }


        if (Ali::verifySign($data)) {
            return new Collection($data);
        }


        throw new InvalidSignException('Alipay Sign Verify FAILED', $data);
    }

    /**
     * find
     *
     * @param $order
     * @param string $type
     * @param bool $transfer
     *
     * @return Collection
     *
     * @throws InvalidSignException
     * @throws RequestException
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function find($order, $type = 'wap', $transfer = false): Collection
    {
        if ($type === true || $transfer) {
            Log::warning('DEPRECATED: In Alipay->find(), the REFUND/TRANSFER param is deprecated since v2.7.3, use TYPE param instead!');
            @trigger_error('In wangyingqian\alichat Alipay->find(), the REFUND/TRANSFER param is deprecated since v2.7.3, use TYPE param instead!', E_USER_DEPRECATED);

            $type = $type === true ? 'refund' : 'transfer';
        }

        $type = $this->getType($type);

        if (!class_exists($type) || !is_callable([new $type(), 'find'])) {
            throw new RequestException("{$type} Done Not Exist Or Done Not Has FIND Method");
        }

        $config = call_user_func([new $type(), 'find'], $order);

        $this->payload['method'] = $config['method'];
        $this->payload['biz_content'] = $config['biz_content'];
        $this->payload['sign'] = $this->getSign($this->payload);


        return Ali::requestApi($this->payload);
    }

    /**
     * refund
     *
     * @param $order
     *
     * @return Collection
     *
     * @throws InvalidSignException
     * @throws RequestException
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function refund($order)
    {
        $this->payload['method'] = 'alipay.trade.refund';
        $this->payload['biz_content'] = json_encode($order);
        $this->payload['sign'] = $this->getSign($this->payload);

        return Ali::requestApi($this->payload);
    }

    /**
     * cancel
     *
     * @param $order
     *
     * @return Collection
     *
     * @throws InvalidSignException
     * @throws RequestException
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function cancel($order): Collection
    {
        $this->payload['method'] = 'alipay.trade.cancel';
        $this->payload['biz_content'] = json_encode(is_array($order) ? $order : ['out_trade_no' => $order]);
        $this->payload['sign'] = $this->getSign($this->payload);


        return Ali::requestApi($this->payload);
    }

    /**
     * close
     *
     * @param $order
     *
     * @return Collection
     *
     * @throws InvalidSignException
     * @throws RequestException
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function close($order): Collection
    {
        $this->payload['method'] = 'alipay.trade.close';
        $this->payload['biz_content'] = json_encode(is_array($order) ? $order : ['out_trade_no' => $order]);
        $this->payload['sign'] = $this->getSign($this->payload);


        return Ali::requestApi($this->payload);
    }

    /**
     * download
     *
     * @param $bill
     *
     * @return string
     *
     * @throws InvalidSignException
     * @throws RequestException
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function download($bill): string
    {
        $this->payload['method'] = 'alipay.data.dataservice.bill.downloadurl.query';
        $this->payload['biz_content'] = json_encode(is_array($bill) ? $bill : ['bill_type' => 'trade', 'bill_date' => $bill]);
        $this->payload['sign'] = $this->getSign($this->payload);


        $result = Ali::requestApi($this->payload);

        return ($result instanceof Collection) ? $result->get('bill_download_url') : '';
    }

    /**
     * voucher
     *
     * @param $method
     * @param array|null $params
     *
     * @return Collection
     *
     * @throws InvalidSignException
     * @throws RequestException
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function fund($method, array $params = null)
    {
        $config = $this->container['alipay.fund']->{$method}($params);

        $this->payload['method'] = $config['method'];
        $this->payload['biz_content'] = $config['biz_content'];
        $this->payload['sign'] = Ali::generateSign($this->payload);

        return Ali::requestApi($this->payload);
    }


    /**
     * sign
     *
     * @param $payload
     *
     * @return string
     *
     * @throws \Wangyingqian\AliChat\Exception\InvalidConfigException
     */
    public function getSign($payload)
    {
        return Ali::generateSign($payload);
    }

    protected function getType($type)
    {
        return get_class($this).'\\'.ucfirst($type).'\\'.Str::studly($type);
    }

}