<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;

class SecurityController extends Controller
{
	/**
	 * @Route("/login", name="login")
	 * @param Request $request
	 *
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function loginAction(Request $request)
	{
		$session = $request->getSession();

		// get the login error if there is one
		$error = $session->get(Security::AUTHENTICATION_ERROR);
		$session->remove(Security::AUTHENTICATION_ERROR);

		return $this->render('AppBundle::security/login.html.twig', array(
			'last_username' => $session->get(Security::LAST_USERNAME),
			'error'         => $error,
		));
	}

	/**
	 * @Route("/logout", name="logout")
	 */
	public function logoutAction(){

	}
}