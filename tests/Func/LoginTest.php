<?php

namespace App\Tests\Func;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginTest extends AbstractEndPoint
{
    public function testLoginSuccess(): void
    {
        $this->getToken();
        /*static::createClient()
            ->request(Request::METHOD_POST, "/api/login_check",
            [
                "json" => [
                    "username" => "user@user.fr",
                    "password" => "123456",
                ]
            ]);;*/
        $this->assertResponseIsSuccessful();
    }

    public function testLoginFailled(): void
    {
        static::createClient()
            ->request(Request::METHOD_POST, "/api/login_check",
            [
                "json" => [
                    "username" => "no_user@no_user.fr",
                    "password" => "bad_password",
                ]
            ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
}
