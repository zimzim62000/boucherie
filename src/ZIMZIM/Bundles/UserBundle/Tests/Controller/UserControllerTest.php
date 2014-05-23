<?php

namespace ZIMZIM\Bundles\UserBundle\Tests\Controller;

use ZIMZIM\Test\ZimzimWebTestCase;

class UserControllerTest extends ZimzimWebTestCase
{

    public $client;
    public $router;

    public function setUp()
    {
        $this->client = static::createClient(array(), $this->users['SuperAdmin']);
        $this->router = $this->client->getContainer()->get('router');
    }

    public function testIndex()
    {
        $route = $this->router->generate('zimzim_bundles_user_list');
        $crawler = $this->client->request('GET', $route);
        $this->assertEquals(
            200,
            $this->client->getResponse()->getStatusCode(),
            "Unexpected HTTP status code for GET " . $route
        );

    }
}
