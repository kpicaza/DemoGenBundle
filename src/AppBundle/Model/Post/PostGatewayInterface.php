<?php

namespace AppBundle\Model\Post;


/**
 * PostGateway Interface.
 */
interface PostGatewayInterface
{
    /**
     * @param string|integer|Post $id
     */
    public function find($id);
    /**
     * @param array $criteria
     * @param array $sort
     * @param integer $limit
     * @param integer $skip
     */
    public function findBy(array $criteria, array $sort = null, $limit = null, $skip = null);
    /**
     * @param array $criteria
     */
    public function findOneBy(array $criteria, array $orderBy = null);
    /**
     * @return Post
     */
    public function findNew($subject = null, $description = null);
    /**
     * @param PostInterface $post
     * @return PostInterface
     */
    public function insert(PostInterface $post);
    /**
    * Update Post.
    */
    public function update();
    /**
    * @param $id
    */
    public function remove(PostInterface $post);
}
