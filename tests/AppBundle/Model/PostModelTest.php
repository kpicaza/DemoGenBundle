<?php

namespace Tests\AppBundle\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Entity\Post;
use AppBundle\Repository\PostGateway;
use AppBundle\Model\Post\PostFactory;
use AppBundle\Model\Post\PostRepository;
use Faker;

class PostRepositoryTest extends WebTestCase
{
    /**
     * @var PostFactory
     */
    private $factory;

    /**
     * @var Faker\
     */
    private $faker;

    /**
     * @var PostGateway
     */
    private $gateway;

    /**
     * @var PostRepository
     */
    private $repository;

    /**
     * Set up PostRepository.
     */
    public function setUp()
    {
        parent::setUp();
        $gatewayClassname = 'AppBundle\Repository\PostGateway';
        $this->gateway = $this->prophesize($gatewayClassname);
        $this->factory = new PostFactory();
        $this->repository = new PostRepository($this->gateway->reveal(), $this->factory);
        $this->faker = Faker\Factory::create();
    }

    public function testPost($return = false)
    {
        $post = new Post();

        $post
            ->setTitle($this->faker->sentence(3))
            ->setDescription($this->faker->text(180))
            ->setCreated($this->faker->datetime)
            ->setUpdated($this->faker->datetime)
        ;

        if (true === $return) {
            return $post;
        }
    }

    public function testFindOneByWithParams()
    {
        $fakePost = $this->testPost(true);

        $this->gateway->findOneBy(array())->willReturn($fakePost);
        $fakePost = $this->factory->makeOne($fakePost);

        $post = $this->repository->findOneBy(array());

        $this->assertTrue($post instanceof Post);

        $this->assertEquals($post->getId(), $fakePost->getId());
        $this->assertEquals($post->getTitle(), $fakePost->getTitle());
        $this->assertEquals($post->getDescription(), $fakePost->getDescription());
        $this->assertEquals($post->getCreated(), $fakePost->getCreated());
        $this->assertEquals($post->getUpdated(), $fakePost->getUpdated());
    }

    public function testFindByWithParams()
    {
        $fakePost = $this->testPost(true);

        $this->gateway->findBy(array(), null, null, null)->willReturn(array($fakePost));
        $fakePosts = $this->factory->makeAll(array($fakePost));

        $posts = $this->repository->findBy(array(), null, null, null);
        foreach ($posts as $key => $post) {
            $this->assertTrue($post instanceof Post);
            $this->assertEquals($post->getId(), $fakePost->getId());
            $this->assertEquals($post->getTitle(), $fakePost->getTitle());
            $this->assertEquals($post->getDescription(), $fakePost->getDescription());
            $this->assertEquals($post->getCreated(), $fakePost->getCreated());
            $this->assertEquals($post->getUpdated(), $fakePost->getUpdated());
        }
    }

}
