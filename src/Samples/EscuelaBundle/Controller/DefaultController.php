<?php

namespace Samples\EscuelaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/{page}.{_format}", defaults={"page"="index", "_format"="html"}, name="_app_home", options={"expose"=true})
     */
    public function indexAction($page)
    {
        return $this->render('SamplesEscuelaBundle:Default:'.$page.'.html.twig');
    }
}
