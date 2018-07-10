<?php

namespace Samples\PropinasEstudiantisBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EstudanteAdmin extends Admin {

    protected $translationDomain = 'SamplesPropinasEstudiantisBundle';
    protected $datagridValues = array(
        '_page' => 1, // Display the first page (default = 1)
        '_sort_order' => 'ASC', // Descendant ordering (default = 'ASC')
        '_sort_by' => 'nome' // name of the ordered field (default = the model id field, if any)
    );

    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) {
        $collection->clearExcept(array('list', 'create', 'edit', 'delete', 'batch'));
    }

    public function getExportFormats() {
        return array(
                // 'json', 'xml', 'csv', 'xls'
        );
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
                ->add('bi')
                ->add('nome')
                ->add('curso')
                ->add('turma')
                ->add('classe')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        
        $ano_lectivo = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesPropinasEstudiantisBundle:AnoLectivo")
                ->findOneBy(array("ano" => date("Y")));

        $mes = array("J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D");

        $listMapper
                ->addIdentifier('nome')
                ->add('curso')
                ->add('classeturma', null, array("label" => "Turma"));

        for ($i = 1; $i <= 12; $i++) {
            if ($ano_lectivo->getPagoDoMes($i) && $ano_lectivo->getPagoDoMes($i) != 0 && $ano_lectivo->getPagoDoMes($i) != "0") {
                $listMapper->add('pagomes' . $i, 'boolean', array("label" => $mes[$i - 1]));
            }
        }
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper) {

        $form_pagamento = $formMapper->create('pagamento', 'form', array('label' => false, 'by_reference' => true, "data_class" => "Samples\PropinasEstudiantisBundle\Entity\Pagamento"));

        $mes = array("Janeiro", "Fevereiro", "Março", "April", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");

        $ano_lectivo = $this->getConfigurationPool()->getContainer()
                ->get("doctrine")->getRepository("SamplesPropinasEstudiantisBundle:AnoLectivo")
                ->findOneBy(array("ano" => date("Y")));

        for ($i = 1; $i <= 12; $i++) {
            if ($ano_lectivo->getPagoDoMes($i) && $ano_lectivo->getPagoDoMes($i) != 0 && $ano_lectivo->getPagoDoMes($i) != "0") {
                $form_pagamento->add('data_pago_mes_' . $i, 'date', array(
                            "label" => "Data do Pago de " . $mes[$i - 1],
                            "widget" => "single_text",
                            "required" => false,
                            "format" => "yyyy-MM-dd",
                            "read_only" => false,
                            "attr" => array('onmouseover' => '$(this).datepicker({ dateFormat: "yy-mm-dd"});')
                                )
                        )
                        ->add('pago_mes_' . $i, 'money', array("label" => "Pago de " . $mes[$i - 1], "required" => false, "currency" => "akz", "attr" => array("placeholder" => $ano_lectivo->getPagoDoMes($i))))
                ;
            }
        }

        $formMapper
                //->add('id')
                ->with("Dados Pessoais")
                ->add('nome')
                ->add('bi')
                /*
                  ->add('data_nacimento', 'date', array(
                  "label" => "Data de Nacimento",
                  "widget" => "single_text",
                  "format" => "yyyy-MM-dd",
                  "read_only" => false,
                  "attr" => array('onmouseover' => '$(this).datepicker({ dateFormat: "yy-mm-dd"});')
                  ))
                  ->add('provincia_nacimento')
                  ->add('municipio_nacimento')
                 */
                ->add('curso')
                ->add('classe')
                ->add('turma')
                ->end()
                ->with('Pagamentos')->add($form_pagamento)->end()
        ;
    }

    public function prePersist($object) {

        parent::prePersist($object);

        $object->getPagamento()->setEstudante($object);

        if (!$object->getPagamento()->getAnoLectivo()) {
            $ano_lectivo = $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getRepository("SamplesPropinasEstudiantisBundle:AnoLectivo")
                    ->findOneBy(array("ano" => date("Y")));
            $object->getPagamento()->setAnoLectivo($ano_lectivo);
        }
    }

    function preUpdate($object) {

        parent::preUpdate($object);

        $object->getPagamento()->setEstudante($object);

        if (!$object->getPagamento()->getAnoLectivo()) {
            $ano_lectivo = $this->getConfigurationPool()->getContainer()
                    ->get("doctrine")->getRepository("SamplesPropinasEstudiantisBundle:AnoLectivo")
                    ->findOneBy(array("ano" => date("Y")));
            $object->getPagamento()->setAnoLectivo($ano_lectivo);
        }
    }

    function postUpdate($object) {

        parent::postUpdate($object);
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->add('bi')
                ->add('nome')
                ->add('turma')
                ->add('classe')
        ;
    }

    public function getTemplate($name) {
        switch ($name) {
            case 'edit':
                return "SamplesPropinasEstudiantisBundle:Admin:Estudante/edit.html.twig";
            default:
                return parent::getTemplate($name);
        }
    }

}
