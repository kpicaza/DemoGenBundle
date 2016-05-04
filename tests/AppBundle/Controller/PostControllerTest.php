<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Faker;

class PostControllerTest extends WebTestCase
{

    const ROUTE = '/api/posts';
    const ROUTE_ID = '/api/posts/%s';

    /**
     * @var Faker\
     */
    private $faker;

    private $client = null;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker\Factory::create();
        $this->client = static::createClient();
    }

    public function testCreatePostWithInvalidParams()
    {
        $this->client->request('POST', self::ROUTE, array(
            "title" => null,
            "description" => null,
            "created" => null,
            "updated" => null,
        ));
            $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
        }

    public function testCreatePost()
    {
        $this->client->request('POST', self::ROUTE, array(
           "title" => $this->faker->sentence(3),
           "description" => $this->faker->text(180),
        ));
        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

}
