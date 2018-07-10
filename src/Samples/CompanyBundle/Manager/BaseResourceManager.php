<?php

namespace Samples\CompanyBundle\Manager;

/**
 * BaseResourceManager
 *
 */
abstract class BaseResourceManager {

    protected $entity_manager;

    /**
     * 
     * @param \Doctrine\ORM\EntityManager $entity_manager
     * @return \Samples\CompanyBundle\Manager\BaseResourceManager
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entity_manager) {
        $this->entity_manager = $entity_manager;
        return $this;
    }

    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEntityManager() {
        return $this->entity_manager;
    }

    /**
     * Get an Entity Repository
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getEntityRepository($class = null) {
        return $this->getEntityManager()->getRepository($class? : $this->getResourceShortcutClass());
    }

    /**
     * @return string
     */
    abstract public function getResourceShortcutClass();

    /**
     * Get query of all elements
     * 
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getBaseQueryBuidler() {
        return $this->getEntityRepository()->createQueryBuilder('r_');
    }

    /**
     * Throw a custom exception
     * 
     * @param string $message
     * @param string $type
     * @throws \RuntimeException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Exception
     */
    function throwException($message, $type = 'default') {

        switch ($type) {
            case 'runtime':
                throw new \RuntimeException($message);
            case 'not-found':
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException($message);
            case 'security':
                throw new \Symfony\Component\Security\Core\Exception\AccessDeniedException($message);
            default:
                throw new \Exception($message);
        }
    }

    /**
     * 
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    function getResultFromQueryBuilder(\Doctrine\ORM\QueryBuilder $queryBuilder) {

        $query = $queryBuilder->getQuery();

        $result = $query->getResult();

        return $result;
    }

    /**
     * Fetch a Resource or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return mixed
     *
     * @throws NotFoundHttpException
     */
    public function find($id) {
        if (!($object = $this->getEntityRepository()->find($id))) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        }

        return $object;
    }

    /**
     * Get a list of Resources.
     *
     *
     * @return array
     */
    public function findAll() {
        return $this->getBaseQueryBuidler()->getQuery()->execute();
    }

    /**
     * Get a paginated list of Resources.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function getAllPaginated($limit = 32, $offset = 0) {
        return $this->getBaseQueryBuidler()->setMaxResults($limit)
                        ->setFirstResult($offset)
                        ->getQuery()->execute();
    }

    /**
     * Get count of all elements
     * 
     * @return integer
     */
    public function getAllCount() {
        $query = $this->getBaseQueryBuidler()
                        ->select('COUNT(r_)')->getQuery();
        return $query->getSingleScalarResult();
    }

    /**
     * Returns an instance of managed entity class
     * 
     * @return \Samples\CompanyBundle\Manager\entityClass
     */
    public function createNewInstance() {
        $entityClass = $this->getResourceClass();
        return new $entityClass();
    }

    /**
     * Persist element
     * 
     * @param type $object
     */
    public function persist($object) {
        $em = $this->getEntityManager();
        $em->persist($object);
        $em->flush();
    }

    /**
     * Delete element
     * 
     * @param type $object
     */
    public function remove($object) {
        $em = $this->getEntityManager();
        $em->remove($object);
        $em->flush();
    }

    /**
     * Creates a custom paginator
     * 
     * @param integer $page
     * @param integer $limit
     * @return \Pagerfanta\Pagerfanta
     */
    public function createPagerfantaPaginator($page = 1, $limit = 32) {
        $pager = new \Pagerfanta\Pagerfanta(new \Pagerfanta\Adapter\DoctrineORMAdapter($this->getBaseQueryBuidler()));
        $pager->setCurrentPage($page);
        $pager->setMaxPerPage($limit);
        return $pager;
    }

    abstract protected function getResourceClass();

    /**
     * Get Form Type for Resource
     */
    abstract public function getResourceFormType($object, $action = "POST");
}
