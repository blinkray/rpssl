<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/play');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertCount(1, $crawler->filter('form'));
        $this->assertCount(4, $crawler->filter('button'));
    }

    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/playAction');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertCount(1, $crawler->filter('form'));
        $this->assertCount(4, $crawler->filter('button'));
        $this->assertCount(3, $crawler->filter('table'));
    }

}