<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use UserBundle\Form\LoginForm;

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
		/*$session = $request->getSession();
		$error = $session->get(Security::AUTHENTICATION_ERROR);
		$session->remove(Security::AUTHENTICATION_ERROR);*/

		$authenticationUtils = $this->get('security.authentication_utils');

		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		$form = $this->createForm(LoginForm::class, [
			'_username' => $lastUsername,
		]);

		return $this->render('AppBundle::security/login.html.twig', array(
			'form' => $form->createView(),
			'error'         => $error,
		));
	}

	/**
	 * @Route("/logout", name="logout")
	 */
	public function logoutAction(){

	}
}