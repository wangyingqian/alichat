<?php
namespace Wangyingqian\AliChat\Support;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Http
{
    /**
     *
     * @return Request
     */
    public static function createFromGlobals()
    {
        return Request::createFromGlobals();
    }

    /**
     * reply
     *
     * @param string $msg
     *
     * @return Response
     */
    public static function success(string $msg)
    {
        return Response::create($msg .'success');
    }
}