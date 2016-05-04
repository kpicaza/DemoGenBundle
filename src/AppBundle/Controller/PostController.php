<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use AppBundle\Exception\InvalidFormException;

/**
 * Post controller.
 *
 */
class PostController extends FOSRestController
{
    /**
     * Lists all Post entities.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @ApiDoc(
     *   section = "Posts",
     *   description = "Get posts list.",
     *   statusCodes = {
     *     200 = "Show post info.",
     *     401 = "Authentication failure, user does not have permission or API token is invalid or outdated.",
     *     403 = "Authorization failure, user does not have permission to access this area.",
     *   }
     * )
     */
    public function getPostsAction()
    {
        try {
            $posts = $this->get('app.api_post_handler')->getBy(array());

            $view = $this->view($posts, Response::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            $view = $this->view($exception->getForm(), Response::HTTP_BAD_REQUEST);
        }

        return $this->handleView($view);
    }
    /**
     * Finds and displays a Post entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @ApiDoc(
     *   section = "Posts",
     *   description = "Get post by ID.",
     *   statusCodes = {
     *     200 = "Show post info.",
     *     401 = "Authentication failure, user does not have permission or API token is invalid or outdated.",
     *     403 = "Authorization failure, user does not have permission to access this area.",
     *   }
     * )
     */
    public function getPostAction($id)
    {
        $post = $this->get('app.api_post_handler')->get($id);

        if (null === $post) {
            throw new NotFoundHttpException('Post not found');
        }

        $view = $this->view($post);

        return $this->handleView($view);
    }
    /**
     * Creates a new Post entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @ApiDoc(
     *   section = "Posts",
     *   description = "Create new post.",
     *   parameters={
     *       {"name"="title", "dataType"="string", "required"=true},
     *       {"name"="description", "dataType"="text", "required"=true},
     *   },
     *   statusCodes = {
     *     201 = "New post was created.",
     *     401 = "Authentication failure, user does not have permission or API token is invalid or outdated.",
     *   }
     * )
     */
    public function postPostAction(Request $request)
    {
        try {
            $post = $this->get('app.api_post_handler')->post(
                $request->request->all()
            );

            $view = $this->view(array(), Response::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            $view = $this->view($exception->getForm(), Response::HTTP_BAD_REQUEST);
        }

        return $this->handleView($view);
    }
    /**
     * Update an existing Post entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @ApiDoc(
     *   description = "Update post by ID.",
     *   section = "Posts",
     *   parameters={
     *       {"name"="title", "dataType"="string", "required"=true},
     *       {"name"="description", "dataType"="text", "required"=true},
     *   },
     *   statusCodes = {
     *     204 = "Post successfully updated.",
     *     401 = "Authentication failure, user does not have permission or API token is invalid or outdated.",
     *     403 = "Authorization failure, user does not have permission to access this area.",
     *   }
     * )
     */
    public function putPostAction(Request $request, $id)
    {
        try {
            $post = $this->get('app.api_post_handler')->put(
                $id,
                $request->request->all()
            );
            $view = $this->view(array(), Response::HTTP_NO_CONTENT);
        } catch (InvalidFormException $exception) {
            $view = $this->view($exception->getForm(), Response::HTTP_BAD_REQUEST);
        }

        return $this->handleView($view);
    }
    /**
     * Deletes a Post entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @ApiDoc(
     *   section = "Posts",
     *   description = "Delete post by id.",
     *   statusCodes = {
     *     204 = "Post was successfully deleted.",
     *     401 = "Authentication failure, user does not have permission or API token is invalid or outdated.",
     *     403 = "Authorization failure, user does not have permission to access this area.",
     *   }
     * )
     */
    public function deletePostAction(Request $request, $id)
    {
        $deleted = $this->get('app.api_post_handler')->delete($id);


        if (false === $deleted) {
            $view = $this->view(array(), 404);
        }
        else {
            $view = $this->view(array(), 204);
        }

        return $this->handleView($view);
    }
    /**
     * Display a Post resource options.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @ApiDoc(
     *   section = "Posts",
     *   description = "Display a Post resource options.",
     *   statusCodes = {
     *     200 = "Show post info.",
     *     400 = "Invalid request.",
     *   }
     * )
     */
    public function optionsPostsAction()
    {
        $options = $this->get('app.api_post_handler')->options();

        $view = $this->view($options);

        $response = $this->handleView($view);

        $response->headers->set('Allow', 'OPTIONS, GET, PUT, POST, DELETE');

        return $response;
    }

}
