<?php

namespace Samples\CompanyBundle\Manager;

/**
 * CompanyManager
 *
 */
class CompanyManager extends BaseResourceManager {

    public function getResourceFormType($object, $action = "POST") {
        return "Samples\\CompanyBundle\\Form\\CompanyType";
    }

    public function getResourceClass() {
        return "Samples\\CompanyBundle\\Entity\\Company";
    }

    public function getResourceShortcutClass() {
        return "SamplesCompanyBundle:Company";
    }

    public function getBaseQueryBuidler() {
        $qb = parent::getBaseQueryBuidler();
        return $qb->addOrderBy($qb->getRootAliases()[0] . '.id', 'ASC');
    }

    //----------------------------------------------------------

    /**
     * 
     * @param string $feature_name
     * @param string $feature_value
     * @return type
     */
    function getCompanyByAttribute($feature_name, $feature_value) {

        $company = $this->getEntityRepository('SamplesCompanyBundle:Company')
                ->findOneBy(array($feature_name => $feature_value));

        if (is_null($company) || !($company instanceof \Samples\CompanyBundle\Entity\Company)) {
            $this->throwException('Resource not found', 'not-found');
        }

        return $company;
    }

}
