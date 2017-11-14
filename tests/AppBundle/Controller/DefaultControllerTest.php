<?php
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Click submit to process the feed!', $client->getResponse()->getContent());
    }

    public function testProcessFeed()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/process/xml/feed');

        $this->assertContains('Method Not Allowed', $client->getResponse()->getContent());
    }

}
