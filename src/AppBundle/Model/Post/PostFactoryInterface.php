<?php

namespace AppBundle\Model\Post;

use AppBundle\Model\Post\PostInterface;

/**
 * PostFactoryInterface.
 */
interface PostFactoryInterface
{
    /**
     * @param array $rawPosts
     * @param array $params
     * @return array|Post
     */
    public function makeAll(array $rawPosts, array $params = array());
    /**
    * @param PostInterface $rawPost
    * @return PostInterface
    */
    public function makeOne($rawPost, array $params = array());
    /**
    * @param PostInterface $rawUser
    * @return PostInterface
    */
    public function make(PostInterface $rawPost, array $params = array());
}