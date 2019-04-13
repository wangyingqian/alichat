<?php
namespace Wangyingqian\AliChat\Support;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class Http
{
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

    /**
     * respond
     *
     * @param $respond
     *
     * @return Response
     */
    public static function respond($respond)
    {
        return Response::create($respond);
    }
}