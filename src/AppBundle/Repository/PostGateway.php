<?php

namespace AppBundle\Repository;

use AppBundle\Model\Post\PostGatewayInterface;
use AppBundle\Model\Post\PostInterface;
use AppBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

/**
 * PostGateway extends EntityRepository implements PostGatewayInterface.
 */
class PostGateway extends EntityRepository implements PostGatewayInterface
{
    /**
     * @param string|integer|Post $id
     */
    public function find($id)
    {
        return parent::find($id);
    }
    /**
     * @param array $criteria
     * @param array $sort
     * @param integer $limit
     * @param integer $skip
     */
    public function findBy(array $criteria, array $sort = null, $limit = null, $skip = null)
    {
        return parent::findBy($criteria, $sort, $limit, $skip);
    }
    /**
     * @param array $criteria
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        return parent::findOneBy($criteria);
    }
    /**
     * @return Post
     */
    public function findNew($subject = null, $description = null)
    {
        return new Post($subject, $description);
    }
    /**
     * @param PostInterface $post
     * @return PostInterface
     */
    public function insert(PostInterface $grade)
    {
        $this->_em->persist($grade);
        $this->_em->flush();

        return $grade;
    }
    /**
    * Update Post.
    */
    public function update()
    {
        $this->_em->flush();
    }
    /**
    * @param $id
    */
    public function remove(PostInterface $post)
    {
        $this->_em->remove($post);
        $this->_em->flush();
    }
}
