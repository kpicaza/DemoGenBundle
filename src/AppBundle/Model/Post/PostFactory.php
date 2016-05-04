<?php

namespace AppBundle\Model\Post;

use AppBundle\Model\Post\PostInterface;
use AppBundle\Model\Post\PostFactoryInterface;

/**
 * Factory implements PostFactoryInterface.
 */
class PostFactory implements PostFactoryInterface
{
    /**
     * @param array $rawPosts
     * @param array $params
     * @return array|Post
     */
    public function makeAll(array $rawPosts, array $params = array())
    {
        $posts = array();

        foreach ($rawPosts as $rawPost) {
            $posts[] = $this->make($rawPost, $params);
        }

        return $posts;
    }
    /**
    * @param PostInterface $rawPost
    * @return PostInterface
    */
    public function makeOne($rawPost, array $params = array())
    {
        return $this->make($rawPost, $params);
    }
    /**
    * @param PostInterface $rawUser
    * @return PostInterface
    */
    public function make(PostInterface $rawPost, array $params = array())
    {
        // You can format object, in this case we left it to return as raw object, feedback is welcome!
        return $rawPost;
    }
}