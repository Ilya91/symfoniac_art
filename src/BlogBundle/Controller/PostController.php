<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all post entities.
     * @Route("/posts", name="post_index")
     * @Template("BlogBundle::post/index.html.twig", vars={"posts"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('BlogBundle:Post')->findAll();

        return [
            'posts' => $posts,
        ];
    }

	/**
	 * Creates a new post entity.
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('BlogBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_show', array('id' => $post->getId()));
        }

        return $this->render('BlogBundle::post/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

	/**
	 * Finds and displays a post entity.
	 *
	 * @param Post $post
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
    public function showAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('BlogBundle::post/show.html.twig', array(
            'post' => $post,
            'delete_form' => $deleteForm->createView(),
        ));
    }

	/**
	 * Displays a form to edit an existing post entity.
	 *
	 * @param Request $request
	 * @param Post $post
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
    public function editAction(Request $request, Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('BlogBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_edit', array('id' => $post->getId()));
        }

        return $this->render('BlogBundle::post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

	/**
	 * Deletes a post entity.
	 *
	 * @param Request $request
	 * @param Post $post
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post)
    {
	    /** @var TYPE_NAME $this */
	    return $this->createFormBuilder()
	                ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
	                ->setMethod('DELETE')
	                ->getForm()
        ;
    }
}
