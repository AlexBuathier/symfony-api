<?php

namespace App\Tests\Func;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteExpenseTest extends AbstractEndPoint
{

    public function testGetCollectionLoggedUser()
    {
        $this->createClientWithCredentials()->request(Request::METHOD_GET, "/api/note_expenses",);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testGetCollectionNotLoggedUser()
    {
        $this->createClient()->request(Request::METHOD_GET, "/api/note_expenses");
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testGetItemLoggedUser()
    {
        $this->createClientWithCredentials()->request(Request::METHOD_GET, "/api/note_expenses/1");
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testGetItemNotLoggedUser()
    {
        $this->createClient()->request(Request::METHOD_GET, "/api/note_expenses/1");
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

     public function testDeleteItemLoggedUser()
      {
          $this->createClientWithCredentials()->request(Request::METHOD_DELETE, "/api/note_expenses/2");
          $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
      }

    public function testDeleteItemNotLoggedUser()
    {
        $this->createClient()->request(Request::METHOD_DELETE, "/api/note_expenses/3");
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testPutItemLoggedUser()
    {
        $this->createClientWithCredentials()->request(Request::METHOD_PUT, "/api/note_expenses/4",
            [
                "json" => [
                    "noteDate" => "2021-04-12",
                    "amount" => 4.51,
                    "noteType" => "/api/note_types/3",
                    "company" => "/api/companies/2"
                ]
            ]);

        $this->assertJsonContains([
            '@context' => '/api/contexts/NoteExpense',
            '@id' => '/api/note_expenses/4',
            "@type" => "NoteExpense",
            "noteDate" => "2021-04-12",
            "amount"  => 4.51,
            "noteType" => [
                "@id" => "/api/note_types/3",
                "@type" => "NoteType"
            ],
            "company" => [
                "@id" => "/api/companies/2",
                "@type" => "Company"
            ]
        ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testPutItemNotLoggedUser()
    {
        $this->createClient()->request(Request::METHOD_PUT, "/api/note_expenses/2",
            [
                "json" => [
                    "noteDate" => "2022-05-12",
                    "amount" => 5.11,
                    "noteType" => "/api/note_types/1",
                    "company" => "/api/companies/1"
                ]
            ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }

    public function testPostItemLoggedUser()
    {
        $this->createClientWithCredentials()->request(Request::METHOD_POST, "/api/note_expenses",
            [
                "json" => [
                    "noteDate" => "2022-05-10",
                    "amount" => 14.94,
                    "noteType" => "/api/note_types/4",
                    "company" => "/api/companies/3"
                ]
            ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }

    public function testPostItemNotLoggedUser()
    {
        $response = static::createClient();
        $response->request(Request::METHOD_POST, "/api/note_expenses",
            [
                "json" => [
                    "noteDate" => "2022-05-10",
                    "amount" => 14.94,
                    "noteType" => "/api/note_types/4",
                    "company" => "/api/companies/3"
                ]
            ]);
        $this->assertResponseStatusCodeSame(Response::HTTP_UNAUTHORIZED);
    }
}
