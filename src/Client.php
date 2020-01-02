<?php

namespace Glooby\Pexels;

/**
 * @author Emil Kilhage <emil@glooby.com>
 */
class Client
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    private function getClient()
    {
        if (null === $this->client) {
            $this->client = new \GuzzleHttp\Client([
              'base_uri' => 'https://api.pexels.com/v1/',
              'headers' => [
                'Authorization' => $this->token
              ]
            ]);
        }

        return $this->client;
    }

    /**
     * @param string $query
     * @param int $size
     * @param int $page
     *
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function search($query, $size = 15, $page = 1)
    {
        return $this->getClient()->get('search?'.http_build_query([
            'query' => $query,
            'per_page' => $size,
            'page' => $page
          ]));
    }

    /**
     * @param int $size
     * @param int $page
     *
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    public function curated($size = 15, $page = 1)
    {
        return $this->getClient()->get('curated?'.http_build_query([
            'per_page' => $size,
            'page' => $page
          ]));
    }
}
