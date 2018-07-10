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
use Samples\CompanyBundle\Entity\Resource;
use Samples\CompanyBundle\Form\ResourceType;

/**
 * API controller.
 *
 */
abstract class BaseApiController extends FOSRestController {

    /**
     * @return \Samples\CompanyBundle\Manager\BaseResourceManager
     */
    abstract protected function getResourceManager();

    /**
     * Processes the form.
     *
     * @param Resource $resource
     * @param array         $parameters
     * @param String        $method
     *
     * @return Resource
     *
     * @throws \Acme\BlogBundle\Exception\InvalidFormException
     */
    protected function processForm(Request $request, $resource, $method = "POST") {

        $formType = $this->getResourceManager()->getResourceFormType($resource, $method);

        $form = $this->createForm($formType, $resource, array('method' => $method));

        $format = $request->getRequestFormat()? : $request->get('_format', 'json');

        if ('html' === $format) {
            $form->handleRequest($request);
        } else {
            $form->submit($request, 'PATCH' !== $method);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $resource = $form->getData();

            $this->getResourceManager()->persist($resource);

            $view = $this->view($resource, \FOS\RestBundle\Util\Codes::HTTP_OK);
            $configuredView = $this->configureViewTemplate($request, $view, null, $resource, 'GET');

            return $this->handleView($configuredView);
        }

        $view = $this->view($form, \FOS\RestBundle\Util\Codes::HTTP_BAD_REQUEST); // HTTP_BAD_REQUEST

        $configuredView = $this->configureViewTemplate($request, $view, $form, $resource, strtoupper($method));

        return $this->handleView($configuredView);
    }

    /**
     * Create a new Resource.
     *
     * @param array $parameters
     *
     * @return Resource
     */
    protected function processPost(Request $request) {
        $resource = $this->createResource($request);
        return $this->processForm($request, $resource, 'POST');
    }

    /**
     * Edit a Resource.
     *
     * @param Resource $resource
     * @param array         $parameters
     *
     * @return Resource
     */
    protected function processPut(Request $request, $resource) {
        return $this->processForm($request, $resource, 'PUT');
    }

    /**
     * Partially update a resource.
     *
     * @param mixed $resource
     * @param array $parameters
     *
     * @return Resource
     */
    protected function processPatch(Request $request, $resource) {
        return $this->processForm($request, $resource, 'PATCH');
    }

    /**
     * Add template configuration for render in alternative html format
     * 
     * @return \FOS\RestBundle\View\View
     */
    protected function configureViewTemplate(Request $request, View $view, $form, $resources, $method) {

        $template = '';

        switch ($method) {
            case 'LIST':
                $view->setTemplate($this->getViewTemplateFolder() . ":list.html.twig")
                        ->setTemplateData(array('list' => $resources))
                        ->setTemplateVar('list')
                ;
                return $view;
            case 'GET':
                $view->setTemplate($this->getViewTemplateFolder() . ":get.html.twig")
                        ->setTemplateData(array('object' => $resources))
                        ->setTemplateVar('object')
                ;
                return $view;
            case 'DELETE':
                $view->setTemplate($this->getViewTemplateFolder() . ":delete.html.twig")
                ;
                return $view;
            case 'POST':
                $template = $this->getViewTemplateFolder() . ":post.html.twig";
                break;
            case 'PUT':
                $template = $this->getViewTemplateFolder() . ":put.html.twig";
                break;
            case 'PATCH':
                $template = $this->getViewTemplateFolder() . ":patch.html.twig";
                break;
            case 'CRUD':
                $view->setTemplate($this->getViewTemplateFolder() . ":crud.html.twig")
                ;
                return $view;
            case 'PAGINATED':
                $view->setTemplate($this->getViewTemplateFolder() . ":paginated.html.twig")
                ;
                return $view;

            default:
                throw new \Symfony\Component\Translation\Exception\NotFoundResourceException(sprintf("The template '%s' was not found.", $method));
        }

        $templateData = array('form' => $form->createView(), 'object' => $resources);

        $configuredView = $view
                ->setTemplate($template)
                ->setTemplateData($templateData)
                ->setTemplateVar('form')
                ->setTemplateVar('object')
        ;

        return $configuredView;
    }

    /**
     * @return string
     */
    abstract protected function getViewTemplateFolder();

    /**
     * @return string
     */
    abstract protected function getPaginatedActionRouteName(Request $request);


//----------------------------------------------------------------------------

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
     * @Security("has_role('ROLE_API_LIST')")
     * 
     * @param Request               $request      the request object
     * @return View
     */
    public function listAction(Request $request) {

        $resources = $this->getResourceManager()->findAll();

        /**
         * view to render for json and xml formats
         */
        $view = $this->view($resources, \FOS\RestBundle\Util\Codes::HTTP_OK);

        $configuredView = $this->configureViewTemplate($request, $view, null, $resources, 'LIST');

        return $this->handleView($configuredView);
    }

    /**
     * Gets a resource for a given id.
     * 
     * @ApiDoc(
     *   resource = true,
     *   description = "Get a resource for a given id",
     *   output = "Samples\CompanyBundle\Entity\Resource",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the resource is not found"
     *   }
     * )
     *
     * @FOSRest\Get("/{id}",options={"expose"=true})  
     * 
     * @Security("has_role('ROLE_API_GET')")
     * 
     * @param Request $request the request object
     * @param mixed     $id      the resource id
     *
     * @return array
     *
     * @throws NotFoundHttpException when resource not exist
     */
    public function getAction(Request $request, $id) {

        $resource = $this->getResourceManager()->find($id);

        $view = $this->view($resource, \FOS\RestBundle\Util\Codes::HTTP_OK);

        $configuredView = $this->configureViewTemplate($request, $view, null, $resource, 'GET');

        return $this->handleView($configuredView);
    }

    /**
     * Create a Resource from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new resource from the submitted data.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Post("",options={"expose"=true})  
     * 
     * @Security("has_role('ROLE_API_POST')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postAction(Request $request) {
        return $this->processPost($request);
    }

    /**
     * Update a Resource from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Update a resource from the submitted data.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Put("/{id}",options={"expose"=true})  
     * 
     * @Security("has_role('ROLE_API_PUT')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function putAction(Request $request, $id) {
        $resource = $this->getResourceManager()->find($id);
        return $this->processPut($request, $resource);
    }

    /**
     * Update partially a Resource from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Update partially a resource from the submitted data.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the data has errors"
     *   }
     * )
     *
     * @FOSRest\Patch("/{id}",options={"expose"=true})  
     *
     * @Security("has_role('ROLE_API_PATCH')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function patchAction(Request $request, $id) {

        $resource = $this->getResourceManager()->find($id);
        return $this->processPatch($request, $resource);
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
     * @Security("has_role('ROLE_API_DELETE')")
     * 
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function deleteAction(Request $request, $id) {

        $resource = $this->getResourceManager()->find($id);
        $this->getResourceManager()->remove($resource);

        $view = $this->view(null, \FOS\RestBundle\Util\Codes::HTTP_OK);

        $configuredView = $this->configureViewTemplate($request, $view, null, null, 'DELETE');

        return $this->handleView($configuredView);
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
     * @Security("has_role('ROLE_API_COUNT')")
     * 
     * @return integer
     */
    public function countAction(Request $request) {
        $count = $this->getResourceManager()->getAllCount();
        return new \Symfony\Component\HttpFoundation\Response($count);
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
     * @Security("has_role('ROLE_API_PAGINATED')")
     * 
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     * @return array
     */
    public function paginatedAction(Request $request, ParamFetcherInterface $paramFetcher) {

        $page = $paramFetcher->get('page', 1);
        $limit = $paramFetcher->get('limit', 32);

        $pager = $this->getResourceManager()->createPagerfantaPaginator($page, $limit);

        $resources = $pager->getNbResults();

        $pagerfantaFactory = new PagerfantaFactory();
        // you can pass the page,
        // and limit parameters name
        $paginatedCollection = $pagerfantaFactory->createRepresentation(
                $pager, new \Hateoas\Configuration\Route(
                $this->getPaginatedActionRouteName($request), array(), true)
        );

        /**
         * view to render for json and xml formats
         */
        $view = $this->view($paginatedCollection, \FOS\RestBundle\Util\Codes::HTTP_OK);

        $configuredView = $this->configureViewTemplate($request, $view, null, $resources, 'PAGINATED');

        return $this->handleView($configuredView);
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
     * @Security("has_role('ROLE_API_TEMPLATES')")
     * 
     * @return FormTypeInterface
     */
    public function templatesAction(Request $request, $action) {

        $method = strtoupper($action);

        $formType = $this->getResourceManager()->getResourceFormType(null, $action);

        $form = $this->createForm($formType);

        $view = $this->view($form, \FOS\RestBundle\Util\Codes::HTTP_OK);

        $view->setFormat('html');

        $configuredView = $this->configureViewTemplate($request, $view, $form, null, $method);

        return $this->handleView($configuredView);
    }

}
