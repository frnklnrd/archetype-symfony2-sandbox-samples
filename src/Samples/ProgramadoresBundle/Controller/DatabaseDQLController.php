<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/dql")
 */
class DatabaseDQLController extends Controller {

    /**
     * @Route("/listado-1", name="samples_programadores_database_dql_ejemplo_1")
     */
    public function listado1Action() {

        $programadores = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:Programador")->findAll();

        return $this->render('SamplesProgramadoresBundle:Database:DQL/programadores-listado.html.twig', array('programadores' => $programadores));
    }

    /**
     * @Route("/listado-2", name="samples_programadores_database_dql_ejemplo_2")
     */
    public function listado2Action() {

        $query = $this->getDoctrine()->getManager()
                ->createQuery('SELECT p'
                . ' FROM SamplesProgramadoresBundle:Programador p'
                . ' ORDER BY p.nombre');

        $programadores = $query->getResult();

        return $this->render('SamplesProgramadoresBundle:Database:DQL/programadores-listado.html.twig', array('programadores' => $programadores));
    }

    /**
     * @Route("/listado-3", name="samples_programadores_database_dql_ejemplo_3")
     */
    public function listado3Action() {

        $query = $this->getDoctrine()->getManager()
                ->createQuery('SELECT p,s,l'
                . ' FROM SamplesProgramadoresBundle:Programador p'
                . ' LEFT JOIN p.sistema_operativo s'
                . ' LEFT JOIN p.lenguajes_programacion l'
                . ' ORDER BY p.nombre');

        $programadores = $query->getResult();

        return $this->render('SamplesProgramadoresBundle:Database:DQL/programadores-listado.html.twig', array('programadores' => $programadores));
    }

    /**
     * @Route("/listado-4", name="samples_programadores_database_dql_ejemplo_4")
     */
    public function listado4Action() {

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesProgramadoresBundle:Programador')
                ->createQueryBuilder('p')
                ->leftJoin('p.sistema_operativo','s')
                ->leftJoin('p.lenguajes_programacion','l')
                ->orderBy('p.nombre', 'ASC');

        // la consulta final quedará de la siguiente forma 
        // $dql_query = $queryBuilder->getDql();
        // echo $dql_query;

        $query = $queryBuilder->getQuery(); // $this->getDoctrine()->getManager()->createQuery($dql_query);
        
        $programadores = $query->getResult();

        return $this->render('SamplesProgramadoresBundle:Database:DQL/programadores-listado.html.twig', array('programadores' => $programadores));
    }

    /**
     * @Route("/listado-5", name="samples_programadores_database_dql_ejemplo_5")
     */
    public function listado5Action() {

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesProgramadoresBundle:Programador')
                ->createQueryBuilder('p')
                ->addSelect('s')
                ->addSelect('l')
                ->leftJoin('p.sistema_operativo','s')
                ->leftJoin('p.lenguajes_programacion','l')
                ->orderBy('p.nombre', 'ASC');

        // la consulta final quedará de la siguiente forma 
        // $dql_query = $queryBuilder->getDql();
        // echo $dql_query;

        $query = $queryBuilder->getQuery(); // $this->getDoctrine()->getManager()->createQuery($dql_query);
        
        $programadores = $query->getResult();

        return $this->render('SamplesProgramadoresBundle:Database:DQL/programadores-listado.html.twig', array('programadores' => $programadores));
    }

}
