<?php

namespace UserBundle\Security;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use UserBundle\Form\LoginForm;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator    {

	private $formFactory;
	private $em;
	private $router;
	private $passwordEncoder;

	public function __construct(
	    FormFactoryInterface $formFactory,
        EntityManagerInterface $em,
        RouterInterface $router,
        UserPasswordEncoderInterface $passwordEncoder
    ){
		$this->formFactory = $formFactory;
		$this->em = $em;
		$this->router = $router;
		$this->passwordEncoder = $passwordEncoder;
	}

	/**
	 * Return the URL to the login page.
	 *
	 * @return string
	 * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
	 */
	protected function getLoginUrl() {
		return $this->router->generate('login');
	}

	/**
	 * Get the authentication credentials from the request and return them
	 * as any type (e.g. an associate array).
	 *
	 * Whatever value you return here will be passed to getUser() and checkCredentials()
	 *
	 * For example, for a form login, you might:
	 *
	 *      return array(
	 *          'username' => $request->request->get('_username'),
	 *          'password' => $request->request->get('_password'),
	 *      );
	 *
	 * Or for an API token that's on a header, you might use:
	 *
	 *      return array('api_key' => $request->headers->get('X-API-TOKEN'));
	 *
	 * @param Request $request
	 *
	 * @return mixed Any non-null value
	 *
	 * @throws \UnexpectedValueException If null is returned
	 */
	public function getCredentials( Request $request ) {
		if ( !($request->attributes->get('_route') === 'login' && $request->isMethod('POST'))){
			return;
		}

		$form = $this->formFactory->create(LoginForm::class);
		$form->handleRequest($request);

		$data = $form->getData();
		$request->getSession()->set(
			Security::LAST_USERNAME,
			$data['_username']
		);

		return $data;
	}

	/**
	 * Return a UserInterface object based on the credentials.
	 *
	 * The *credentials* are the return value from getCredentials()
	 *
	 * You may throw an AuthenticationException if you wish. If you return
	 * null, then a UsernameNotFoundException is thrown for you.
	 *
	 * @param mixed $credentials
	 * @param UserProviderInterface $userProvider
	 *
	 * @throws AuthenticationException
	 *
	 * @return UserInterface|null
	 */
	public function getUser( $credentials, UserProviderInterface $userProvider ) {
		$username = $credentials['_username'];
		return $this->em->getRepository('UserBundle:User')
		                ->findOneBy(['username' => $username]);
	}

	/**
	 * Returns true if the credentials are valid.
	 *
	 * If any value other than true is returned, authentication will
	 * fail. You may also throw an AuthenticationException if you wish
	 * to cause authentication to fail.
	 *
	 * The *credentials* are the return value from getCredentials()
	 *
	 * @param mixed $credentials
	 * @param UserInterface $user
	 *
	 * @return bool
	 *
	 * @throws AuthenticationException
	 */
	public function checkCredentials( $credentials, UserInterface $user ) {
		$password = $credentials['_password'];
		if ($this->passwordEncoder->isPasswordValid($user, $password)) {
			return true;
		}

		return false;
	}

	/**
	 * @return string
	 */
	protected function getDefaultSuccessRedirectUrl()
	{
		return $this->router->generate('post_index');
	}
}