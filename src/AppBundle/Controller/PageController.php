<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    /**
     * @Route("/page/number")
     */
	public function numberAction()
	{
		$number = mt_rand(0, 100);

		return $this->render('page/index.html.twig', [
			'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
		]);
	}
}
