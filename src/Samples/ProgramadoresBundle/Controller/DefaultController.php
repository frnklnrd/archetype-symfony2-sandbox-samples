<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="samples_programadores_index")
     */
    public function indexAction()
    {
        return $this->render('SamplesProgramadoresBundle:Default:index.html.twig');
    }
}
