<?php

namespace RestApiBundle\Controller;

use RestApiBundle\Entity\Role;
use RestApiBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Component\HttpKernel\Exception\HttpException;
use RestApiBundle\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use RestApiBundle\Entity\EntityMerger;

class MoviesController extends AbstractController
{
    use ControllerTrait;

    /**
     * @var EntityMerger
     */
    private $entityMerger;
    /**
     * @var MoviePagination
     */
    private $moviePagination;
    /**
     * @var RolePagination
     */
    private $rolePagination;

    /**
     * @param EntityMerger $entityMerger
     */
    public function __construct(
        EntityMerger $entityMerger
    ) {
        $this->entityMerger = $entityMerger;
    }

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

    public function postMoviesAction(
        Movie $movie, ConstraintViolationListInterface $validationErrors
    ) {
        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

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

	/**
	 * @Rest\View()
	 * @param Request $request
	 * @param Movie $movie
	 *
	 * @return
	 */
	public function getMovieRolesAction(Request $request, Movie $movie)
	{
		return $movie->getRoles();
	}

	/**
	 * @Rest\View(statusCode=201)
	 * @ParamConverter("role", converter="fos_rest.request_body", options={"deserializationContext"={"groups"={"Deserialize"}}})
	 * @Rest\NoRoute()
	 * @param Movie $movie
	 * @param Role $role
	 * @param ConstraintViolationListInterface $validationErrors
	 *
	 * @return Role
	 * @throws \RestApiBundle\Exception\ValidationException
	 */
	public function postMovieRolesAction(
		Movie $movie, Role $role,
		ConstraintViolationListInterface $validationErrors
	) {
		if (count($validationErrors) > 0) {
			throw new ValidationException($validationErrors);
		}

		$role->setMovie($movie);

		$em = $this->getDoctrine()
		           ->getManager();

		$em->persist($role);
		$movie->getRoles()
		      ->add($role);

		$em->persist($movie);
		$em->flush();

		return $role;
	}

    /**
     * @Rest\NoRoute()
     * @ParamConverter("modifiedMovie", converter="fos_rest.request_body",
     *     options={"validator" = {"groups" = {"Patch"}}}
     * )
     * @Security("is_authenticated()")
     * @param Movie $movie
     * @param Movie $modifiedMovie
     * @param ConstraintViolationListInterface $validationErrors
     * @return \FOS\RestBundle\View\View|Movie
     */
    public function patchMovieAction(
        Movie $movie, Movie $modifiedMovie,
        ConstraintViolationListInterface $validationErrors
    ) {
        if (null === $movie) {
            return $this->view(
                null,
                404
            );
        }

        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        // Merge entities
        $this->entityMerger->merge(
            $movie,
            $modifiedMovie
        );

        // Persist
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($movie);
        $em->flush();

        // Return
        return $movie;
    }

}