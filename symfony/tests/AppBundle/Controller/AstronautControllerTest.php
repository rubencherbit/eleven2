<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client;

class AstronautControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new Client([
            'base_uri' => 'http://eleven2.dev'
        ]);
    }
    public function testget()
    {
        $response = $this->client->get('/api/astronauts/1', [
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('birthdate', $data);
        $this->assertArrayHasKey('height', $data);
        $this->assertArrayHasKey('weight', $data);
    }

    public function testcget()
    {
        $response = $this->client->get('/api/astronauts', [
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('name', $data[0]);
        $this->assertArrayHasKey('birthdate', $data[0]);
        $this->assertArrayHasKey('height', $data[0]);
        $this->assertArrayHasKey('weight', $data[0]);
    }

    // public function testpost()
    // {
    // }
}
