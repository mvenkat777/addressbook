<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testContactsListIndexPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contacts');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('h1:contains("List Contacts")')->count());
    }

    public function testContactsAddPage()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/view-add-contact');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('h1:contains("Add new contact")')->count());
    }

}
