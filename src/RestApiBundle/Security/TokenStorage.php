<?php

namespace RestApiBundle\Security;

use Predis\Client;

class TokenStorage
{
    const KEY_SUFFIX = '-token';
    /**
     * @var Client
     */
    private $redisClient;

    /**
     * @param Client $redisClient
     */
    public function __construct(Client $redisClient)
    {
        $this->redisClient = $redisClient;
    }

    /**
     * @param string $username
     * @param string $token
     */
    public function storeToken($username, $token)
    {
        $this->redisClient->set(
            $username.self::KEY_SUFFIX,
            $token
        );
        $this->redisClient->expire(
            $username.self::KEY_SUFFIX,
            3600
        );
    }

    /**
     * @param string $username
     */
    public function invalidateToken($username)
    {
        $this->redisClient->del($username.self::KEY_SUFFIX);
    }

    /**
     * @param string $username
     * @param string $token
     * @return bool
     */
    public function isTokenValid(string $username,$token)
    {
        return $this->redisClient->get($username.self::KEY_SUFFIX) === $token;
    }
}