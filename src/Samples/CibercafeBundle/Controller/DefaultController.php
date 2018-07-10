<?php

namespace Samples\CibercafeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller {

    /**
     * @Route("/", name="samples_cibercafe_index", options={"expose"=true})
     */
    public function indexAction() {
        return $this->render('SamplesCibercafeBundle:Default:index.html.twig');
    }

}
