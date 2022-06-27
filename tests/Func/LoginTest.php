<?php

namespace App\Tests\Func;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

class LoginTest extends ApiTestCase
{
    public function testLoginSuccess(): void
    {
        $this->login(false);
        $this->assertResponseIsSuccessful();
    }

    public function testLoginFailled(): void
    {
        $this->login(true);
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);

    }

    private function login($isBadCredential): void
    {
        $client = static::createClient();
        if (!$isBadCredential) {
            $client->request(Request::METHOD_POST, "/api/login_check",
                [
                    "json" => [
                        "username" => "user@user.fr",
                        "password" => "123456",
                    ]
                ]);
        } else {
            $client->request(Request::METHOD_POST, "/api/login_check",
                [
                    "json" => [
                        "username" => "no_user@no_user.fr",
                        "password" => "bad_password",
                    ]
                ]);
        }
    }
}
