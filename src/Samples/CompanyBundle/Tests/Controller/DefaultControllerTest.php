<?php

namespace Samples\CompanyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/app/samples/company/');

        $this->assertContains('ng-app="application"', $client->getResponse()->getContent());
    }
}
