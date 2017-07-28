<?php

namespace Tests\AppBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AstronautEntityTest extends WebTestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testGetterAndSetter()
    {
        $astronaut = $this->em
            ->getRepository('AppBundle:Astronaut')
            ->find(1);
        ;

        $this->assertEquals(1, $astronaut->getId());
        $this->assertNotNull($astronaut->getName());
        $this->assertNotNull($astronaut->getBirthdate());
        $this->assertNotNull($astronaut->getWeight());
        $this->assertNotNull($astronaut->getHeight());
    }
}
