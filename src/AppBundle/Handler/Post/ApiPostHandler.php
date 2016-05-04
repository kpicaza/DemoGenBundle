<?php

namespace AppBundle\Handler\Post;

use AppBundle\Model\Post\PostRepository;
use Symfony\Component\Form\FormFactoryInterface;
use AppBundle\Model\Post\PostInterface;
use AppBundle\Exception\InvalidFormException;
use AppBundle\Form\PostType;

/**
 * ApiPostHandler service.
 */
class ApiPostHandler
{
    /**
     * @var PostRepository
     */
    protected $repository;
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;
    /**
     * Init Handler.
     *
     * @param PostRepository $repository
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(PostRepository $repository, FormFactoryInterface $formFactory)
    {
        $this->repository = $repository;
        $this->formFactory = $formFactory;
    }
    /**
    * Get Post object list from repository.
    *
    * @param array $criteria
    * @param array $sort
    * @param integer $limit
    * @param integer $skip
    */
    public function getBy(array $criteria, array $sort = null, $limit = null, $skip = null)
    {
        return $this->repository->findBy($criteria, $sort, $limit, $skip);
    }
    /**
    * Get Post object from repository.
    *
    * @param integer $id
    */
    public function get($id)
    {
        return $this->repository->find($id);
    }
    /**
    * Insert Post object to repository.
    *
    * @param array $params
    */
    public function post(array $params)
    {
        $post = $this->repository->findNew();
        $form = $this->formFactory->create(PostType::class, $post, array('method' => 'POST'));
        $form->submit($params);

        if ($form->isValid()) {
            $rawPost = $this->repository->insert($post);

            return $rawPost;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }
    /**
    * Update Post object from repository.
    *
    * @param integer|string $id
    * @param array $params
    */
    public function put($id, array $params)
    {
        $post = $this->repository->find($id);
        $form = $this->formFactory->create(PostType::class, $post, array('method' => 'PUT'));
        $form->submit($params);

        if ($form->isValid()) {
            $this->repository->update();
            return $post;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }
    /**
    * @param integer|string $id
    */
    public function delete($id)
    {
        $post = $this->repository->find($id);

        if (null === $post) {
            return false;
        }

        $this->repository->remove($post);

        return true;
    }
    /**
    * Get Resources info.
    */
    public function options()
    {
        return array(
            'GET' => array(
                'description' => 'Get list of posts or get a resource by id.',
                'parameters' => array(
                    'id' => array(
                        'type' => 'integer|string',
                        'description' => 'Post Id.',
                        'required' => false
                    )
                )
            ),
            'POST' => array(
                'description' => 'Create anew reource of type Post',
                'parameters' => array(
                    'title' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'description' => array(
                        'type' => 'text',
                        'required' => true
                    ),
                    'created' => array(
                        'type' => 'datetime',
                        'required' => true
                    ),
                    'updated' => array(
                        'type' => 'datetime',
                        'required' => false
                    ),
                )
            ),
            'PUT' => array(
                'description' => 'Create anew reource of type Post',
                'parameters' => array(
                    'id' => array(
                        'type' => 'integer',
                        'required' => true
                    ),
                    'title' => array(
                        'type' => 'string',
                        'required' => true
                    ),
                    'description' => array(
                        'type' => 'text',
                        'required' => true
                    ),
                    'created' => array(
                        'type' => 'datetime',
                        'required' => true
                    ),
                    'updated' => array(
                        'type' => 'datetime',
                        'required' => false
                    ),
                )
            ),
            'DELETE' => array(
                'description' => 'Delete a Post resource by id.',
                'parameters' => array(
                    'id' => array(
                        'type' => 'integer|string',
                        'description' => 'Post Id.',
                        'required' => false
                    )
                )
            ),
        );
    }
}
