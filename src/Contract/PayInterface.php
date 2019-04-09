<?php
namespace Wangyingqian\AliChat\Contract;

interface PayInterface
{
    /**
     * Pay
     *
     * @param string $endpoint
     * @param array  $payload
     */
    public function pay($endpoint, array $payload);
}