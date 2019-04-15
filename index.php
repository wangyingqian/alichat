<?php

require_once 'vendor/autoload.php';


class PayController
{
    public function trade()
    {
        $order = [
            'out_trade_no' => '1555123497xe232',
            'subject' =>'苹果',
            'total_amount' => '10.1',
            'product_code' => 'FAST_INSTANT_TRADE_PAY'
        ];
        $alipay = \Wangyingqian\AliChat\Facade\AlipayTrade::web($order);

        return $alipay->send();
    }

   public function fund()
   {
       $params = [
           'out_order_no' => '2016101210002001810258115912',
           'out_request_no' => '2016101200104001110081001',
//           'order_title' => 'xxx',
           'remark' => '23',
//           'payee_user_id'=>'2088021260830853'
       ];

       $alipay = \Wangyingqian\AliChat\AliChat::alipay($this->config)->fund('freeze', $params);


       echo  $alipay;

   }
}

$alipay = new PayController();

$alipay->trade();
