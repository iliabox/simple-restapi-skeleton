<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PingControllerTest extends WebTestCase
{
    public function testPing()
    {
        $client = static::createClient();

        $client->request(Request::METHOD_GET, '/');

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $content = $client->getResponse()->getContent();
        $response = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('message', $response);
        $this->assertSame('OK', $response['message']);
    }
}
