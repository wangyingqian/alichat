<?php

require_once 'vendor/autoload.php';


class PayController
{
    public function trade()
    {
        $order = [
            'out_trade_no' => \Wangyingqian\AliChat\Support\Str::random(12),
            'subject' =>'苹果',
            'total_amount' => '14.1',
//            'buyer_id' => '2088102146225135'
        ];
        $alipay = \Wangyingqian\AliChat\Facade\AlipayTrade::scan($order);

        return $alipay;
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

       $alipay = \Wangyingqian\AliChat\Facade\AlipayFund::appFreeze($params);


       return  $alipay;

   }

   public function common()
   {
       $params = [
           'scopes' => ['auth_user'],
           'state' => '51hs'
       ];
//       $order = [
//           'bill_type' => 'trade',
//           'bill_date' => '2019-04-12'
//       ];

       $re = \Wangyingqian\AliChat\Facade\AlipayCommon::auth($params);

       return $re;


   }
}

$alipay = new PayController();



$alipay->common();
