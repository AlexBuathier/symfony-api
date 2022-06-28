<?php

namespace App\Tests\Func;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Symfony\Component\HttpFoundation\Request;

class AbstractEndPoint extends ApiTestCase
{
    private $token;

    private array $options = [
        "json" => [
            "username" => "user@user.fr",
            "password" => "123456",
        ]
    ];

    protected function createClientWithCredentials($token = null): Client
    {
        $token = $token ?: $this->getToken();

        return static::createClient([], ['headers' => ['authorization' => 'Bearer ' . $token]]);
    }

    protected function getToken(): string
    {
        if ($this->token) {
            return $this->token;
        }
        $this->token = static::createClient()->request(
            Request::METHOD_POST,
            "/api/login_check",
            $this->options)->toArray()['token'];
        return $this->token;
    }
}

