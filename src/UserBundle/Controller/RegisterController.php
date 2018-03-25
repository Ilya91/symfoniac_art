<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use UserBundle\Entity\User;
use UserBundle\Form\RegisterFormType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegisterController extends Controller
{
	/**
	 * @Route("/register", name="user_register")
	 * @Template("UserBundle::register/register.html.twig")
	 *
	 * @param Request $request
	 *
	 * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function registerAction(Request $request)
	{
		// 1) build the form
		$user = new User();
		$form = $this->createForm(RegisterFormType::class, $user);

		// 2) handle the submit (will only happen on POST)
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$passwordEncoder = $this->get('security.password_encoder');
			// 3) Encode the password (you could also do this via Doctrine listener)
			$password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
			$user->setPassword($password);

			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			$request->getSession()
			        ->getFlashBag()
			        ->add('success', 'Welcome to the Death Star! Have a magical day!');

			//$this->authenticateUser($user);

			return $this->redirectToRoute('login');
		}
		return array('form' => $form->createView());
	}

	private function encodePassword(User $user, $plainPassword)
	{
		$encoder = $this->container->get('security.encoder_factory')
		                           ->getEncoder($user);

		return $encoder->encodePassword($plainPassword, $user->getSalt());
	}

	private function authenticateUser(User $user)
	{
		$providerKey = 'secured_area'; // your firewall name
		$token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

		//$this->container->get('security.context_listener.0')->setToken($token);
	}
}
