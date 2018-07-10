<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/sql")
 */
class DatabaseSQLController extends Controller {

    /**
     * @Route("/ejemplo-1", name="samples_programadores_database_sql_ejemplo_1")
     */
    public function ejemplo1Action() {

        $conn = $this->get('database_connection');

        // creando sql 

        $sql = "SELECT "
                . " p.nombre as NOMBRE,"
                . " so.nombre as SISTEMA,"
                . " l.nombre as LENGUAJE"
                . " FROM samples_programadores__programador p"
                . " LEFT JOIN samples_programadores__sistema_operativo so ON so.id = p.sistema_id "
                . " LEFT JOIN samples_programadores__lenguajes_preferidos lps ON lps.programador_id = p.id "
                . " LEFT JOIN samples_programadores__lenguaje_programacion l ON l.id = lps.lenguaje_programacion_id "
                . " ORDER BY NOMBRE ASC"
        ;

        // ejecutando la consulta

        $result = $conn->fetchAll($sql);

        // imprimiendo el resultado

        \Doctrine\Common\Util\Debug::dump($result);

        return new Response("");
    }

    /**
     * @Route("/ejemplo-2", name="samples_programadores_database_sql_ejemplo_2")
     */
    public function ejemplo2Action() {

        $conn = $this->get('database_connection');

        // creando sql 

        $sql = "SELECT "
                . " p.nombre as NOMBRE,"
                . " so.nombre as SISTEMA,"
                . " l.nombre as LENGUAJE"
                . " FROM samples_programadores__programador p"
                . " LEFT JOIN samples_programadores__sistema_operativo so ON so.id = p.sistema_id "
                . " LEFT JOIN samples_programadores__lenguajes_preferidos lps ON lps.programador_id = p.id "
                . " LEFT JOIN samples_programadores__lenguaje_programacion l ON l.id = lps.lenguaje_programacion_id "
                . " ORDER BY NOMBRE ASC"
        ;

        // ejecutando la consulta

        $result = $conn->fetchAll($sql);

        // imprimiendo el resultado

        echo "<pre>";
        \Doctrine\Common\Util\Debug::dump($result);
        echo "</pre>";

        return new Response("");
    }

    /**
     * @Route("/ejemplo-3", name="samples_programadores_database_sql_ejemplo_3")
     */
    public function ejemplo3Action() {

        $conn = $this->get('database_connection');

        // creando sql 

        $sql = "SELECT "
                . " p.nombre as NOMBRE,"
                . " so.nombre as SISTEMA,"
                . " l.nombre as LENGUAJE"
                . " FROM samples_programadores__programador p"
                . " LEFT JOIN samples_programadores__sistema_operativo so ON so.id = p.sistema_id "
                . " LEFT JOIN samples_programadores__lenguajes_preferidos lps ON lps.programador_id = p.id "
                . " LEFT JOIN samples_programadores__lenguaje_programacion l ON l.id = lps.lenguaje_programacion_id "
                . " ORDER BY NOMBRE ASC"
        ;

        // ejecutando la consulta

        $result = $conn->fetchAll($sql);

        return $this->render('SamplesProgramadoresBundle:Database:SQL/programadores-listado.html.twig', array('programadores'=>$result));
    }

}
