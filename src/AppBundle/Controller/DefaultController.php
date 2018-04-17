<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     *
     * @Template("AppBundle::default/index.html.twig", vars={"fun"})
     * @return array
     */
    public function indexAction(Request $request)
    {
        $fun = 'Octopuses can change the color of their body in just *three-tenths* of a second!';

	    /*$cache = $this->get('doctrine_cache.providers.my_markdown_cache');
	    $key = md5($fun);

	    if ($cache->contains($key)) {
		    $fun = $cache->fetch( $key );
	    }else{
		    sleep(1);
		    $fun = $this->get('markdown.parser')
		                       ->transform($fun);
			$cache->save($key, $fun);
	    }*/



        $cacheParser = $this->get('app.cache_transformer');
        dump($cacheParser);
        $fun = $cacheParser->parse($fun);

        return [
            'fun' => $fun,
        ];
    }

	/**
	 * @Route("/admin", name="admin")
	 */
	public function adminAction()
	{
		$em = $this->getDoctrine()->getManager();
		$userRepo = $em->getRepository('UserBundle:User');
		var_dump($userRepo->findOneByUsernameOrEmail('user@user.com'));
		if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			throw $this->createAccessDeniedException();
		}
		return new Response('<html><body>Admin page!</body></html>');
	}
}
