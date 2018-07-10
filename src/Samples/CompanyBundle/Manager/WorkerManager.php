<?php

namespace Samples\CompanyBundle\Manager;

/**
 * WorkerManager
 *
 */
class WorkerManager extends BaseResourceManager {

    protected $company_manager;

    /**
     * 
     * @param \Samples\CompanyBundle\Manager\CompanyManager $company_manager
     * @return \Samples\CompanyBundle\Manager\WorkerManager
     */
    public function setCompanyManager(CompanyManager $company_manager) {
        $this->company_manager = $company_manager;
        return $this;
    }
    
    /**
     * 
     * @return \Samples\CompanyBundle\Manager\CompanyManager
     */
    public function getCompanyManager(){
        return $this->company_manager;
    }

    public function getResourceFormType($object, $action = "POST") {
        return "Samples\\CompanyBundle\\Form\\WorkerType";
    }

    public function getResourceClass() {
        return "Samples\\CompanyBundle\\Entity\\Worker";
    }

    public function getResourceShortcutClass() {
        return "SamplesCompanyBundle:Worker";
    }

    public function getBaseQueryBuidler() {
        $qb = parent::getBaseQueryBuidler();
        return $qb->addOrderBy($qb->getRootAliases()[0] . '.id', 'ASC');
    }

    //--------------------------------------------------------------------

    /**
     * 
     * @param string $url
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    function getWorkersByCompanyWebsite($url) {

        $company = $this->getCompanyManager()->getCompanyByAttribute('website', $url);

        $queryBuilder = $this->getBaseQueryBuidler();

        $queryBuilder->andWhere($queryBuilder->getRootAliases()[0] . '.company = :c')
                ->setParameter('c', $company);

        $workers = $this->getResultFromQueryBuilder($queryBuilder);

        return $workers;
    }

}
