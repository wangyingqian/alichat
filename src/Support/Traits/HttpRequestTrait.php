<?php

namespace Wangyingqian\AliChat\Support\Traits;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Trait HttpRequest.
 *
 * @property string baseUri        base_uri
 * @property string timeout        timeout
 * @property string connectTimeout connect_timeout
 */
trait HttpRequestTrait
{
    /**
     * Http client.
     *
     * @var null|Client
     */
    protected $httpClient = null;

    /**
     * Http client options.
     *
     * @var array
     */
    protected $httpOptions = [];

    /**
     * Send a GET request.
     *
     * @param string $endpoint
     * @param array  $query
     * @param array  $headers
     *
     * @return array|string
     */
    public function get($endpoint, $query = [], $headers = [])
    {
        return $this->request('get', $endpoint, [
            'headers' => $headers,
            'query'   => $query,
        ]);
    }

    /**
     * Send a POST request.
     *
     * @param string       $endpoint
     * @param string|array $data
     * @param array        $options
     *
     * @return array|string
     */
    public function post($endpoint, $data, $options = [])
    {
        if (!is_array($data)) {
            $options['body'] = $data;
        } else {
            $options['form_params'] = $data;
        }

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Send request.
     *
     * @param string $method
     * @param string $endpoint
     * @param array  $options
     *
     * @return array|string
     */
    public function request($method, $endpoint, $options = [])
    {
        return $this->unwrapResponse($this->getHttpClient()->{$method}($endpoint, $options));
    }

    /**
     * Set http client.
     *
     * @param Client $client
     *
     * @return $this
     */
    public function setHttpClient(Client $client)
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Get default options.
     *
     * @return array
     */
    public function getOptions()
    {
        return array_merge([
            'base_uri'        => property_exists($this, 'baseUri') ? $this->baseUri : '',
            'timeout'         => property_exists($this, 'timeout') ? $this->timeout : 5.0,
            'connect_timeout' => property_exists($this, 'connectTimeout') ? $this->connectTimeout : 5.0,
        ], $this->httpOptions);
    }

    /**
     * Return http client.
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient()
    {
        if (is_null($this->httpClient)) {
            $this->httpClient = $this->getDefaultHttpClient();
        }

        return $this->httpClient;
    }

    /**
     * Get default http client.
     *
     * @return Client
     */
    public function getDefaultHttpClient()
    {
        return new Client($this->getOptions());
    }

    /**
     * Convert response.
     *
     * @param ResponseInterface $response
     *
     * @return array|string
     */
    public function unwrapResponse(ResponseInterface $response)
    {
        $contentType = $response->getHeaderLine('Content-Type');
        $contents = $response->getBody()->getContents();

        if (false !== stripos($contentType, 'json') || stripos($contentType, 'javascript')) {
            return json_decode($contents, true);
        } elseif (false !== stripos($contentType, 'xml')) {
            return json_decode(json_encode(simplexml_load_string($contents, 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE), true);
        }

        return $contents;
    }

    /**
     * return json
     *
     * @param $data
     *
     * @return string
     */
    public function json($data = null)
    {
        return JsonResponse::create($data)->getContent();
    }

    public function redirect($url)
    {
        RedirectResponse::create($url);
    }
}
