<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default controller.
 *
 * @Route("/")
 */
class DefaultController extends Controller
{

    /**
     * Lists all Article entities.
     *
     * @Route("/", name="default")
     * @Route("/{name}", name="default")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($name = 'world')
    {
        return $this->render('AppBundle:Default:index.html.twig', array('name' => $name));
    }
}
