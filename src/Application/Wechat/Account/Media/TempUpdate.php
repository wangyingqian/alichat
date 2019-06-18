<?php
namespace Wangyingqian\AliChat\Application\Wechat\Account\Media;

use Wangyingqian\AliChat\Application\Wechat\Wechat;
use Wangyingqian\AliChat\Application\WechatManage;

class TempUpdate extends Wechat
{
    public function __construct()
    {
        $this->method = 'cgi-bin/media/upload';

        $this->request = WechatManage::ACCOUNT_REQUEST;
    }
}