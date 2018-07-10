<?php

namespace Samples\CompanyBundle\Controller\API;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Hateoas\Representation\Factory\PagerfantaFactory;
use Hateoas\Representation\PaginatedRepresentation;
use Hateoas\Representation\CollectionRepresentation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Samples\CompanyBundle\Entity\Company;
use Samples\CompanyBundle\Form\CompanyType;

/**
 * Company API controller.
 *
 * @FOSRest\Route("/companies")
 */
class CompanyApiController extends BaseApiController {

    protected function getViewTemplateFolder() {
        return "SamplesCompanyBundle:company";
    }

    protected function getPaginatedActionRouteName(Request $request) {
        return "samples_company_api_companyapi_paginated";
    }

    protected function getResourceManager() {
        return $this->get('samples.company.manager.company');
    }

    //------------------------------------------------------------

    /**
     * List all resources.
     * 
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @FOSRest\Get("",options={"expose"=true})
     *
     * @Security("has_role('ROLE_API_COMPANY_LIST')")
     * 
     * @param Request  $request  the request object
     * @return View
     */
    public function listAction(Request $request) {
        return parent::listAction($request);
    }

    /**
     * Gets a resource for a given id.
     * 
     * @ApiDoc(
     *   resource = true,
     *   description = "Get a resource for a given id",
     *   output = "Samples\CompanyBundle\Entity\Company",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the resource is not found"
     *   }
     * )
     *
     * @FOSRest\Get("/{id}",options={"expose"=true})  
     * 
     * @Security("has_role('ROLE_API_COMPANY_GET')")
     * 
     * @param Request $request the request object
     * @param mixed     $id      the resource id
     *
     * @return array
     *
     * @throws NotFoundHttpException when resource not exist
     */
    public function getAction(Request $request, $id) {
        return parent::getAction($request, $id);
    }

    /**
     * Create a Resource from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new resource from the submitted data.",
     *   input = "Samples\CompanyBundle\Form\CompanyType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Post("")  
     * 
     * @Security("has_role('ROLE_API_COMPANY_POST')")
     * 
     *
     * @param Request $request the request object
     *
     * @return View
     */
    public function postAction(Request $request) {
        return parent::postAction($request);
    }

    /**
     * Update a Resource from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Update a resource from the submitted data.",
     *   input = "Samples\CompanyBundle\Form\CompanyType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Put("/{id}")  
     * 
     * @Security("has_role('ROLE_API_COMPANY_PUT')")
     * 
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function putAction(Request $request, $id) {
        return parent::putAction($request, $id);
    }

    /**
     * Update partially a Resource from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Update partially a resource from the submitted data",
     *   input = "Samples\CompanyBundle\Form\CompanyType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Patch("/{id}")  
     *
     * @Security("has_role('ROLE_API_COMPANY_PATCH')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function patchAction(Request $request, $id) {
        return parent::patchAction($request, $id);
    }

    /**
     * Delete a resource.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Delete a resource.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *   }
     * )
     *
     * @FOSRest\Delete("/{id}",options={"expose"=true})  
     *
     * @Security("has_role('ROLE_API_COMPANY_DELETE')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function deleteAction(Request $request, $id) {
        return parent::deleteAction($request, $id);
    }

    /**
     * Get quantity for all resources.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Get quantity for all resources",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @FOSRest\Get("/options/count",options={"expose"=true})  
     *
     * @Security("has_role('ROLE_API_COMPANY_COUNT')")
     * 
     * @return integer
     */
    public function countAction(Request $request) {
        return parent::countAction($request);
    }

    /**
     * List all resources paginated.

     * @ApiDoc(
     *   resource = true,
     *   description = "List all resources paginated",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @FOSRest\Get("/options/paginated",options={"expose"=true})
     * @FOSRest\QueryParam(name="page", requirements="\d+", nullable=true, default="1", description="Page from which to start listing elements.")
     * @FOSRest\QueryParam(name="limit", requirements="\d+", nullable=true, default="32", description="How many elements to return.")
     *
     * @Security("has_role('ROLE_API_COMPANY_PAGINATED')")
     * 
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     * @return array
     */
    public function paginatedAction(Request $request, ParamFetcherInterface $paramFetcher) {
        return parent::paginatedAction($request, $paramFetcher);
    }

    /**
     * Presents the form to use for a resource action.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Presents the form to use for a resource action",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * 
     * @FOSRest\Get("/options/templates/{action}",options={"expose"=true})  
     *
     * @Security("has_role('ROLE_API_COMPANY_TEMPLATES')")
     * 
     * @return FormTypeInterface
     */
    public function templatesAction(Request $request, $action) {

        return parent::templatesAction($request, $action);
    }

    //-----------------------------------------------------------------------

    /**
     * Get all related workers for a company.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Get all related workers for a company",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Get("/{id}/workers")  
     *
     * @Security("has_role('ROLE_API_COMPANY_WORKER_LIST')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function workersAction(Request $request, $id) {
        $workers = $this->getDoctrine()->getRepository('SamplesCompanyBundle:Worker')
                ->findBy(array('company' => $id));

        $view = $this->view($workers, \FOS\RestBundle\Util\Codes::HTTP_OK); // HTTP_BAD_REQUEST

        /**
         * configure options for html format
         */
        $templateData = array('workers' => $workers);

        $configuredView = $view
                ->setTemplate('SamplesCompanyBundle:worker:gets.html.twig')
                ->setTemplateData($templateData)
                ->setTemplateVar('workers')
        ;

        return $configuredView;
    }

    /**
     * Get a related worker for a company.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Get a related worker for a company",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Get("/{company_id}/workers/{worker_id}")  
     *
     * @Security("has_role('ROLE_API_COMPANY_WORKER_GET')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function workerAction(Request $request, $company_id, $worker_id) {
        $worker = $this->getDoctrine()->getRepository('SamplesCompanyBundle:Worker')
                ->findOneBy(array('company' => $company_id, 'id' => $worker_id));

        $view = $this->view($worker, \FOS\RestBundle\Util\Codes::HTTP_OK); // HTTP_BAD_REQUEST

        /**
         * configure options for html format
         */
        $templateData = array('worker' => $worker);

        $configuredView = $view
                ->setTemplate('SamplesCompanyBundle:worker:get.html.twig')
                ->setTemplateData($templateData)
                ->setTemplateVar('worker')
        ;

        return $configuredView;
    }

    /**
     * Remove relation for a related worker of a company.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Remove relation for a related worker of a company",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Unlink("/{company_id}/workers/{worker_id}")  
     *
     * @Security("has_role('ROLE_API_COMPANY_WORKER_UNLINK')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function unlinkWorkerAction(Request $request, $company_id, $worker_id) {

        $worker = $this->getDoctrine()->getRepository('SamplesCompanyBundle:Worker')
                ->findOneBy(array('company' => $company_id, 'id' => $worker_id));

        $this->getDoctrine()->getManager()->remove($worker);
        $this->getDoctrine()->getManager()->flush($worker);

        $view = $this->view(null, \FOS\RestBundle\Util\Codes::HTTP_OK); // HTTP_BAD_REQUEST

        return $view;
    }

}
