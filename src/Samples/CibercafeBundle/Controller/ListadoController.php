<?php

namespace Samples\CibercafeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Samples\CibercafeBundle\Form\MenuType;
use Doctrine\ORM\QueryBuilder;
use Lexik\Bundle\FormFilterBundle\Filter\ORM\Expr;

class ListadoController extends Controller {

    /**
     * @Route("/listado/usuarios-asociados", name="_app_listado_usuarios_asociados", options={"expose"=true})
     */
    public function listadoUsuariosAsociadosAction() {

        // crear el query buidler con la consulta

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesCibercafeBundle:UsuarioAsociado')
                        ->createQueryBuilder('u')->orderBy('u.nombre', 'ASC');

        // crear el formulario de los filtros con los campos a filtrar

        $filters_form = $this->createFormBuilder(null, array(
                    'csrf_protection' => false,
                    'validation_groups' => array('filtering')
                ))
                ->add('nombre', 'text', array(
                    'label' => 'Nombre(s)',
                    'apply_filter' => function (QueryBuilder $qb, Expr $expr, $field, array $values) {
                        $qb->where($qb->expr()->like('u.nombre', '\'%' . $values["value"] . '%\''));
                    }))
                ->add('apellidos', 'text', array(
                    'label' => 'Apellidos',
                    'apply_filter' => function (QueryBuilder $qb, Expr $expr, $field, array $values) {
                        $qb->where($qb->expr()->like('u.apellidos', '\'%' . $values["value"] . '%\''));
                    }))
                //->add('cant_annos', 'number_range', array('label' => 'Años Asociado'))
                /*            
                ->add('fecha_asociado', 'filter_date_range', array(
                    'label' => 'Fecha de Asociado',
                    'left_date' => array(
                        'widget' => 'single_text',
                        'format' => 'yyyy-MM-dd',
                        'attr' => array('placeholder' => 'después de'),
                        'apply_filter' => function (QueryBuilder $qb, Expr $expr, $field, array $values) {
                            // el campo fecha_asociado debe ser great than or equal al value seleccionado
                            //$qb->where($qb->expr()->gte('u.fecha_asociado', $values["value"]));
                        }
                    ),
                    'right_date' => array(
                        'widget' => 'single_text',
                        'format' => 'yyyy-MM-dd',
                        'attr' => array('placeholder' => 'antes de'),
                        'apply_filter' => function (QueryBuilder $qb, Expr $expr, $field, array $values) {
                            // el campo fecha_asociado debe ser less than or equal al value seleccionado
                            //$qb->where($qb->expr()->lte('u.fecha_asociado', $values["value"]));                            
                        }
                    )
                ))
                 */
                /*->add('categoria', 'filter_entity', array(
                    'label' => 'Categoría',
                    'class' => 'SamplesCibercafeBundle:CategoriaUsuarioAsociado'
                ))*/
                ->add('num_PC_asignada', 'number', array('label' => 'PC asignada'))
                ->add('num_tarjeta_credito', 'text', array('label' => 'Tarjeta de Crédito'))
                ->add('carnet_identidad', 'text', array('label' => 'Carnet de Identidad'))
                ->getForm();

        // si la peticion viene por POST entonces aplicar filtros

        $request = $this->getRequest();

        $method = $request->getMethod();

        if ($method == "POST") {

            // bind values from the request
            $filters_form->bindRequest($this->get('request'));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filters_form, $queryBuilder);

            // now look at the DQL =)
            //var_dump($filterBuilder->getDql());
        }

        // la consulta final quedará de la siguiente forma 
        // $dql_query = $queryBuilder->getDql();

        $query = $queryBuilder->getQuery(); // $this->getDoctrine()->getManager()->createQuery($dql_query);
        // aplicamos paginacion en caso de encontrar un campo page en la peticion

        $paginator = $this->get('ideup.simple_paginator');

        $paginator->setItemsPerPage(15) // cantidad de elementos por páginas
                ->setMaxPagerItems(5) // cantidad de botones de páginas
        ;

        // obtenemos la consulta paginada

        $asociados = $paginator->paginate($query)->getResult();

        return $this->render('SamplesCibercafeBundle:Listado:listado-usuarios-asociados.html.twig', array(
                    'listado' => $asociados,
                    'paginator' => $paginator,
                    'filters_form' => $filters_form->createView()
                ));
    }

    /**
     * @Route("/listado/usuarios-eventuales", name="_app_listado_usuarios_eventuales", options={"expose"=true})
     */
    public function listadoUsuariosEventualesAction() {

        $paginator = $this->get('ideup.simple_paginator');

        $paginator->setItemsPerPage(25) // cantidad de elementos por páginas
                ->setMaxPagerItems(5) // cantidad de botones de páginas
        ;

        $eventuales = $paginator
                        ->paginate($this->getDoctrine()->getRepository('SamplesCibercafeBundle:UsuarioEventual')->findAll())->getResult();

        return $this->render('SamplesCibercafeBundle:Listado:listado-usuarios-eventuales.html.twig', array(
                    'listado' => $eventuales,
                    'paginator' => $paginator));
    }

    /**
     * @Route("/listado/usuarios-y-servicios", name="_app_listado_usuarios_y_servicios", options={"expose"=true})
     */
    public function listadoUsuariosYServiciosAction() {

        $paginator = $this->get('ideup.simple_paginator');

        $paginator->setItemsPerPage(5) // cantidad de elementos por páginas
                ->setMaxPagerItems(5) // cantidad de botones de páginas
        ;

        $usuarios = $paginator
                        ->paginate($this->getDoctrine()->getRepository('SamplesCibercafeBundle:Usuario')->findAll())->getResult();

        return $this->render('SamplesCibercafeBundle:Listado:listado-usuarios-y-servicios.html.twig', array(
                    'listado' => $usuarios,
                    'paginator' => $paginator));
    }

    /**
     * @Route("/listado/servicios-ofertados", name="_app_listado_servicios_ofertados", options={"expose"=true})
     */
    public function listadoServiciosOfertadosAction() {

        $servicios = $this->getDoctrine()->getEntityManager()->createQuery(
                        ' SELECT s'
                        . ' FROM SamplesCibercafeBundle:Servicio s'
                        . ' WHERE s.hora_fin IS NOT NULL')->getResult();

        return $this->render('SamplesCibercafeBundle:Listado:listado-servicios-ofertados.html.twig', array(
                    'listado' => $servicios));
    }

    /**
     * @Route("/listado/servicios-reservacion", name="_app_listado_servicios_reservacion", options={"expose"=true})
     */
    public function listadoServiciosReservacionAction() {

        $servicios = $this->getDoctrine()->getEntityManager()->createQuery(
                        ' SELECT sr'
                        . ' FROM SamplesCibercafeBundle:ServicioReservacion sr')->getResult();

        return $this->render('SamplesCibercafeBundle:Listado:listado-servicios-reservacion.html.twig', array(
                    'listado' => $servicios));
    }

    /**
     * @Route("/listado/recaudacion-total", name="_app_listado_recaudacion_total", options={"expose"=true})
     */
    public function listadoRecaudacionTotalAction() {

        $servicios = $this->getDoctrine()->getEntityManager()->createQuery(
                        ' SELECT s'
                        . ' FROM SamplesCibercafeBundle:Servicio s'
                        . ' WHERE s.hora_fin IS NOT NULL')->getResult();

        $total = 0;
        foreach ($servicios as $servicio) {
            $total += $servicio->getPrecio();
        }
        return $this->render('SamplesCibercafeBundle:Listado:listado-recaudacion-total.html.twig', array(
                    'listado' => $servicios,
                    'total' => $total
                ));
    }

    /**
     * @Route("/listado/menu-dia", name="_app_listado_menu_del_dia", options={"expose"=true})
     */
    public function listadoMenudelDia() {

        // crear el query buidler con la consulta

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesCibercafeBundle:Menu')
                        ->createQueryBuilder('m')->orderBy('m.precio', 'DESC');

        // crear el formulario de los filtros

        $filters_form = $this->createFormBuilder(null, array(
                            'block_name' => 'filters',
                            'csrf_protection' => false,
                            'validation_groups' => array('filtering')
                        ))
                        ->add('nombre', 'text', array(
                            'apply_filter' => function (QueryBuilder $qb, Expr $expr, $field, array $values) {
                                $qb->where($qb->expr()->like('m.nombre', '\'%' . $values["value"] . '%\''));
                            }))
                        //->add('precio', 'filter_number_range')
                        ->getForm()
                        ;

        if ($this->get('request')->query->has('submit-filter')) {

            // bind values from the request
            $filters_form->bindRequest($this->get('request'));

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filters_form, $queryBuilder);

            // now look at the DQL =)
            //var_dump($filterBuilder->getDql());
        }

        $menu = $this->getDoctrine()->getEntityManager()->createQuery($queryBuilder->getDql())->getResult();

        return $this->render('SamplesCibercafeBundle:Listado:listado-menu-del-dia.html.twig', array(
                    'listado' => $menu,
                    'filters_form' => $filters_form->createView()
                ));
    }

    /**
     * @Route("/listado/softwares-disponibles", name="_app_listado_software_disponibles", options={"expose"=true})
     */
    public function listadoSoftwaresDisponibles() {

        $soft = $this->getDoctrine()->getEntityManager()->createQuery(
                        ' SELECT i'
                        . ' FROM SamplesCibercafeBundle:Instalador i'
                        . ' ORDER BY i.nombre ASC'
                )->getResult();

        return $this->render('SamplesCibercafeBundle:Listado:listado-softwares-disponibles.html.twig', array(
                    'listado' => $soft));
    }

}
