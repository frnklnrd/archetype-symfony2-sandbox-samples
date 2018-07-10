<?php

namespace Samples\IndexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="samples_index")
     */
    public function indexAction()
    {
        return $this->render('SamplesIndexBundle:Default:index.html.twig');
    }
}
