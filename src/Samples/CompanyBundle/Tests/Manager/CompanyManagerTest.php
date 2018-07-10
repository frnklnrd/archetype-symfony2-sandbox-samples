<?php

namespace Samples\CompanyBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CompanyManagerTest extends KernelTestCase {

    /**
     * @var \Samples\CompanyBundle\Manager\CompanyManager
     */
    private $company_manager;

    /**
     * {@inheritDoc}
     */
    public function setUp() {
        self::bootKernel();
        $this->company_manager = static::$kernel->getContainer()
                ->get('samples.company.manager.company')
        ;
    }

    public function testGetCompanyByAttributeOk() {
        $company = $this->company_manager->getCompanyByAttribute('website','http://realmadrid.es');
        $this->assertNotNull($company, 'El elemento no deberia ser null');
    }
    
    public function testGetCompanyByAttributeNotOk1() {
        try {
            $company = $this->company_manager->getCompanyByAttribute('website','http://12,43.78io.es');
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exc) {
            return;
        }
        $this->assertTrue(false, 'Debería haber lanzado una excepción de tipo NotFoundHttpException');
    }


    public function testGetCompanyByAttributeNotOk2() {
        try {
            $company = $this->company_manager->getCompanyByAttribute('attribute','http://12,43.78io.es');
        } catch (\Doctrine\ORM\ORMException $exc) {
            return;
        }
        $this->assertTrue(false, 'Debería haber lanzado una excepción de tipo ORMException');
    }

    protected function tearDown() {
        parent::tearDown();
    }

}
