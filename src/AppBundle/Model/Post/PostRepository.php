<?php

namespace AppBundle\Model\Post;

use AppBundle\Model\Post\PostGatewayInterface;
use AppBundle\Model\Post\PostFactoryInterface;

/**
 * Factory implements PostFactoryInterface.
 */
class PostRepository
{
    /**
     * @var \AppBundle\Model\Post\PostGatewayInterface
     */
    private $gateway;
    /**
     * @var \AppBundle\Model\Post\PostFactoryInterface
     */
    private $factory;

    /**
     * @param \AppBundle\Model\Post\PostGatewayInterface $gateway
     * @param \AppBundle\Model\Post\PostFactoryInterface $factory
     */
    public function __construct(PostGatewayInterface $gateway, PostFactoryInterface $factory)
    {
        $this->gateway = $gateway;
        $this->factory = $factory;
    }
    /**
    * @param PostInterface|int $id
    *
    * @return PostInterface
    */
    public function find($id)
    {
        $rawPost = $this->gateway->find($id);

        return $this->factory->makeOne($rawPost);
    }
    /**
    * @param array $criteria
    * @param array $orderBy
    *
    * @return PostInterface
    */
    public function findOneBy(array $criteria)
    {
        $post = $this->gateway->findOneBy($criteria);

        return null === $post ? null : $this->factory->makeOne($post);
    }
    /**
    *
    * @param array $criteria
    * @param array $sort
    * @param integer $limit
    * @param integer $skip
    * @return array
    */
    public function findBy(array $criteria = array(), $sort = null, $limit = null, $skip = null)
    {
        return $this->gateway->findBy($criteria, $sort, $limit, $skip);
    }
    /**
    * @param null $subject
    * @param null $description
    * @return PostInterface
    */
    public function findNew($subject = null, $description = null)
    {
        return $this->gateway->findNew($subject, $description);
    }
    /**
     * @param Post $rawPost
     *
     * @return type
     */
    public function insert(PostInterface $rawPost)
    {
        $post = $this->gateway->insert($rawPost);

        return $this->factory->makeOne($post);
    }
    /**
    * @param PostInterface $rawPost
    *
    * @return bool
    */
    public function update()
    {
        return $this->gateway->update();
    }
    /**
    * @param $id
    */
    public function remove(PostInterface $post)
    {
        $this->gateway->remove($post);
    }
}