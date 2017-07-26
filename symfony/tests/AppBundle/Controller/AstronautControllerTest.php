<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\Client;

class AstronautControllerTest extends WebTestCase
{
    protected $client;
    private $container;
    private $base_uri;

    protected function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
        $this->base_uri = $this->container->get('router')->getContext()->getScheme() . '://' . $this->container->get('router')->getContext()->getHost();

        $this->client = new Client([
            'base_uri' => $this->base_uri
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

    public function testpost()
    {
        $data = [
        'name' => "Mqwe",
        'birthdate' => '01-01-1970',
        'weight' => 70,
        'height' => 190
        ];

        $response = $this->client->post('/api/astronauts', ['json' => $data]);
        $this->assertEquals(201, $response->getStatusCode());
        $data = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('birthdate', $data);
        $this->assertArrayHasKey('weight', $data);
        $this->assertArrayHasKey('height', $data);
    }
}
