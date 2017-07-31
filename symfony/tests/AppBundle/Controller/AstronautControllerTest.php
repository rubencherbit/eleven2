<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AstronautControllerTest extends WebTestCase
{
    public function testget()
    {
        $client = static::createClient();
        $client->request('GET', '/api/astronauts/1');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('birthdate', $data);
        $this->assertArrayHasKey('height', $data);
        $this->assertArrayHasKey('weight', $data);
    }

    public function testcget()
    {
        $client = static::createClient();
        $client->request('GET', '/api/astronauts');

        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('name', $data[0]);
        $this->assertArrayHasKey('birthdate', $data[0]);
        $this->assertArrayHasKey('height', $data[0]);
        $this->assertArrayHasKey('weight', $data[0]);
    }

    public function testCgetWithLimit0()
    {
        $client = static::createClient();
        $client->request('GET', '/api/astronauts?limit=0');

        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testPost()
    {
        $data = [
            'name'      => "Mqwe",
            'birthdate' => '1970-01-01',
            'weight'    => 70,
            'height'    => 190
        ];
        $client = static::createClient();
        $client->request('POST', '/api/astronauts', $data);

        $response = $client->getResponse();
        $this->assertEquals(201, $response->getStatusCode());
        $data = json_decode($response->getContent(true), true);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('birthdate', $data);
        $this->assertArrayHasKey('weight', $data);
        $this->assertArrayHasKey('height', $data);
    }
    public function testPostWithError()
    {
        $data = [
            'name'      => "",
            'birthdate' => '01-01-1970',
            'weight'    => 70,
            'height'    => 190
        ];
        $client = static::createClient();
        $client->request('POST', '/api/astronauts', $data);

        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
    }
}
