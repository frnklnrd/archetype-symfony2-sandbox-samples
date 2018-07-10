<?php

namespace Samples\CompanyBundle\Tests\Manager;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WorkerManagerTest extends KernelTestCase {

    /**
     * @var \Samples\CompanyBundle\Manager\WorkerManager
     */
    private $worker_manager;

    /**
     * {@inheritDoc}
     */
    public function setUp() {
        self::bootKernel();
        $this->worker_manager = static::$kernel->getContainer()
                ->get('samples.company.manager.worker')
        ;
    }

    public function testGetWorkersByCompanyWebsiteOk() {
        $workers = $this->worker_manager->getWorkersByCompanyWebsite('http://realmadrid.es');
        $this->assertGreaterThan(0, $workers, 'Debería encontrar un conjunto de elementos');
    }

    public function testGetWorkersByCompanyWebsiteNotOk() {
        try {
            $workers = $this->worker_manager->getWorkersByCompanyWebsite('http://34eryu67.com');
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $exc) {
            return;
        }
        $this->assertTrue(false, 'Debería haber lanzado una excepción de tipo NotFoundHttpException');
    }

    protected function tearDown() {
        parent::tearDown();
    }

}
