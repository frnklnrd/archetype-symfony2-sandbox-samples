<?php

namespace Samples\CompanyBundle\Tests\Form;

class CompanyFormTest extends \Symfony\Component\Form\Test\TypeTestCase {

    public function testSubmitValidData() {
        
        $formData = array(
            'name'=>'Hello',
            'country'=>'ES',
            'website' =>'http://hello.com.cu'
        );
        
        $object = new \Samples\CompanyBundle\Entity\Company();
        $object->setName('Hello');
        $object->setCountry('ES');
        $object->setWebsite('http://hello.com.cu');
        
        $type = new \Samples\CompanyBundle\Form\CompanyType();
        $form = $this->factory->create($type);
        
        // submit the data to the form directly
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());
        
        // validate if all types are correctly configured
        
        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

}
