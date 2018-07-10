<?php

namespace Samples\CompanyBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="samples_company_index")
     */
    public function indexAction()
    {
        return $this->render('SamplesCompanyBundle:default:index.html.twig');
    }
}
