<?php

namespace RestApiBundle\Controller;

use FOS\RestBundle\Controller\ControllerTrait;
use RestApiBundle\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Rest\View()
     */
    public function getMoviesAction(Request $request)
    {
        $movies = $this->getDoctrine()->getRepository('RestApiBundle:Movie')->findAll();

        return $movies;
    }

    /**
     * @Rest\View(statusCode=201)
     * @ParamConverter("movie", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */

    public function postMoviesAction(Movie $movie) {
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($movie);
        $em->flush();

        return $movie;
    }

    /**
     * @Rest\View()
     * @Security("is_granted('delete', movie)")
     */
    public function deleteMovieAction(Movie $movie)
    {
        if (null === $movie) {
            return $this->view(
                null,
                404
            );
        }

        $em = $this->getDoctrine()
            ->getManager();
        $em->remove($movie);
        $em->flush();
    }

    /**
     * @Rest\View()
     */
    public function getMovieAction(Movie $movie)
    {
        if (null === $movie) {
            return $this->view(
                null,
                404
            );
        }

        return $movie;
    }
}