<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use UO\Bundle\DemoBundle\Entity\Programador;
use UO\Bundle\DemoBundle\Form\ProgramadorType;
use Doctrine\ORM\QueryBuilder;
//use Lexik\Bundle\FormFilterBundle\Filter\ORM\Expr;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

/**
 * @Route("/paginator-filter/programador")
 */
class PaginatorFilterController extends Controller {

    /**
     * @Route("/list", name="samples_programadores_paginator_filter_listado_programador"))
     */
    public function indexAction() {

        // crear el query buidler con la consulta

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesProgramadoresBundle:Programador')
                ->createQueryBuilder('p')
                ->orderBy('p.nombre', 'ASC')
                ->addOrderBy('p.apellido1', 'ASC')
                ->addOrderBy('p.apellido2', 'ASC');

        // crear el formulario de los filtros con los campos a filtrar

        $filters_form = $this->createFormBuilder(null, array(
                    'csrf_protection' => false,
                    'validation_groups' => array('filtering')
                ))
                ->add('ci', 'text', array(
                    'label' => 'Carnet Identidad',
                    'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                        if (empty($values['value'])) {
                            return null;
                        }
                        return $filterQuery->createCondition(
                                        $filterQuery->getExpr()->like($field, '\'%' . $values["value"] . '%\'')
                        );
                    }))
                ->add('nombre', 'text', array(
                    'label' => 'Nombre(s)',
                    'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                        if (empty($values['value'])) {
                            return null;
                        }
                        return $filterQuery->createCondition(
                                        $filterQuery->getExpr()->like($field, '\'%' . $values["value"] . '%\'')
                        );
                    }))
                ->add('apellido1', 'text', array(
                    'label' => 'Primer Apellido',
                    'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                        if (empty($values['value'])) {
                            return null;
                        }
                        return $filterQuery->createCondition(
                                        $filterQuery->getExpr()->like($field, '\'%' . $values["value"] . '%\'')
                        );
                    }))
                ->add('apellido2', 'text', array(
                    'label' => 'Segundo Apellido',
                    'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                        if (empty($values['value'])) {
                            return null;
                        }
                        return $filterQuery->createCondition(
                                        $filterQuery->getExpr()->like($field, '\'%' . $values["value"] . '%\'')
                        );
                    }))
                /* ->add('fecha_nacimiento', 'date_range', array(
                  'label' => 'Fecha de Nacimiento',
                  'left_date_options' => array(
                  'label' => false,
                  'widget' => 'single_text',
                  'format' => 'yyyy-MM-dd',
                  'attr' => array('placeholder' => 'después de'),
                  'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                  // el campo fecha_asociado debe ser great than or equal al value seleccionado
                  if (empty($values['value'])) {return null;}
                  return $filterQuery->createCondition(
                  $filterQuery->getExpr()->gte($field, $values["value"])
                  );
                  }
                  ),
                  'right_date_options' => array(
                  'label' => false,
                  'widget' => 'single_text',
                  'format' => 'yyyy-MM-dd',
                  'attr' => array('placeholder' => 'antes de'),
                  'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                  // el campo fecha_asociado debe ser less than or equal al value seleccionado
                  if (empty($values['value'])) {return null;}
                  return $filterQuery->createCondition(
                  $filterQuery->getExpr()->lte($field, $values["value"])
                  );
                  }
                  )
                  )) */
                /* ->add('certificado', 'boolean', array(
                  'label' => '¿Está certificado?',
                  'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                  if ($values["value"] == "n")
                  return $filterQuery->createCondition(
                  $filterQuery->getExpr()->eq($field, 'false')
                  );
                  else if ($values["value"] == "y")
                  return $filterQuery->createCondition(
                  $filterQuery->getExpr()->eq($field, 'true')
                  );
                  })) */
                ->add('sistema_operativo', 'entity', array(
                    'label' => 'Sistema Preferido',
                    'class' => 'SamplesProgramadoresBundle:SistemaOperativo'
                ))
                ->add('lenguajes_programacion', 'entity', array(
                    'label' => 'Lenguaje conocido',
                    'class' => 'SamplesProgramadoresBundle:LenguajeProgramacion',
                    'apply_filter' => function (QueryInterface $filterQuery, $field, array $values) {
                        if (empty($values['value'])) {
                            return null;
                        }

                        $filterQuery->getQueryBuilder()->leftJoin('p.lenguajes_programacion', 'l');

                        return $filterQuery->createCondition(
                                        $filterQuery->getExpr()->eq('l.nombre', '\'' . $values["value"] . '\'')
                        );
                    }
                ))
                ->getForm();

        // si la peticion viene por POST entonces aplicar filtros

        $request = $this->getRequest();

        $method = $request->getMethod();

        if ($method == "POST") {

            // bind values from the request
            $filters_form->bind($this->get('request'));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filters_form, $queryBuilder);

            // now look at the DQL =)
            //var_dump($filterBuilder->getDql());
        }

        // la consulta final quedará de la siguiente forma 
        //$dql_query = $queryBuilder->getDql(); // echo $dql_query;

        $query = $queryBuilder->getQuery(); // $this->getDoctrine()->getManager()->createQuery($dql_query);
        // aplicamos paginacion en caso de encontrar un campo page en la peticion

        $paginator = $this->get('ideup.simple_paginator');

        $paginator->setItemsPerPage(3) // cantidad de elementos por páginas
                ->setMaxPagerItems(3) // cantidad de botones de páginas
        ;

        // obtenemos la consulta paginada

        $entities = $paginator->paginate($query)->getResult();

        return $this->render("SamplesProgramadoresBundle:PaginatorFilter:index.html.twig", array(
                    'entities' => $entities,
                    'paginator' => $paginator,
                    'filters_form' => $filters_form->createView()
        ));
    }

}
