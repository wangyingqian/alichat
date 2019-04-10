<?php
namespace Wangyingqian\AliChat\Support;

use Symfony\Component\HttpFoundation\RedirectResponse;
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

    /**
     * redirect
     *
     * @param $url
     * @param int $status
     * @param array $header
     *
     * @return RedirectResponse
     */
    public static function redirect($url , $status = 302, $header = [])
    {
        return RedirectResponse::create($url, $status, $header);
    }

    public static function respond($respond)
    {
        return Response::create($respond);
    }
}