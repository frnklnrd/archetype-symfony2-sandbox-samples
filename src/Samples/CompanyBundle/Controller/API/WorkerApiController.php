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
use Samples\CompanyBundle\Entity\Worker;
use Samples\CompanyBundle\Form\WorkerType;

/**
 * Worker API controller.
 *
 * @FOSRest\Route("/workers")
 */
class WorkerApiController extends BaseApiController {

    protected function getViewTemplateFolder() {
        return "SamplesCompanyBundle:worker";
    }

    protected function getResourceManager() {
        return $this->get('samples.company.manager.worker');
    }

    protected function getPaginatedActionRouteName(Request $request) {
        return "samples_company_api_workerapi_paginated";
    }

    //------------------------------------------------------------

    /**
     * List all resources.

     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @FOSRest\Get("",options={"expose"=true})
     *
     * @Security("has_role('ROLE_API_WORKER_LIST')")
     * 
     * @param Request               $request      the request object
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
     *   output = "Samples\CompanyBundle\Entity\Worker",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the resource is not found"
     *   }
     * )
     *
     * @FOSRest\Get("/{id}",options={"expose"=true})  
     * 
     * @Security("has_role('ROLE_API_WORKER_GET')")
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
     *   input = "Samples\CompanyBundle\Form\WorkerType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Post("")  
     * 
     * @Security("has_role('ROLE_API_WORKER_POST')")
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
     *   input = "Samples\CompanyBundle\Form\WorkerType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Put("/{id}")  
     * 
     * @Security("has_role('ROLE_API_WORKER_PUT')")
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
     *   input = "Samples\CompanyBundle\Form\WorkerType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Patch("/{id}")  
     *
     * @Security("has_role('ROLE_API_WORKER_PATCH')")
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
     * @Security("has_role('ROLE_API_WORKER_DELETE')")
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
     * @Security("has_role('ROLE_API_WORKER_COUNT')")
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
     * @Security("has_role('ROLE_API_WORKER_PAGINATED')")
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
     * @Security("has_role('ROLE_API_WORKER_TEMPLATES')")
     * 
     * @return FormTypeInterface
     */
    public function templatesAction(Request $request, $action) {

        return parent::templatesAction($request, $action);
    }

}
