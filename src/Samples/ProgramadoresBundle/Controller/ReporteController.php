<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/reportes")
 */
class ReporteController extends Controller {

    /**
     * @Route("/ejemplo-1", name="samples_programadores_reporte_ejemplo_1")
     */
    public function ejemplo1Action() {

        $query = $this->getDoctrine()->getManager()
                ->createQuery('SELECT p,s,l,proy'
                . ' FROM SamplesProgramadoresBundle:Programador p'
                . ' LEFT JOIN p.sistema_operativo s'
                . ' LEFT JOIN p.lenguajes_programacion l'
                . ' LEFT JOIN p.proyectos proy'
                . ' ORDER BY p.certificado DESC');

        $programadores = $query->getResult();

        return $this->render('SamplesProgramadoresBundle:Reporte:programadores.html.twig', array('programadores' => $programadores));
    }

    /**
     * @Route("/ejemplo-1-print", name="samples_programadores_reporte_ejemplo_1_print")
     */
    public function ejemplo1PrintAction() {

        $query = $this->getDoctrine()->getManager()
                ->createQuery('SELECT p,s,l,proy'
                . ' FROM SamplesProgramadoresBundle:Programador p'
                . ' LEFT JOIN p.sistema_operativo s'
                . ' LEFT JOIN p.lenguajes_programacion l'
                . ' LEFT JOIN p.proyectos proy'
                . ' ORDER BY p.certificado DESC');

        $programadores = $query->getResult();

        return $this->render('SamplesProgramadoresBundle:Reporte:programadores.print.twig', array('programadores' => $programadores));
    }

    /**
     * @Route("/ejemplo-2", name="samples_programadores_reporte_ejemplo_2")
     */
    public function ejemplo2Action() {

        $conn = $this->get('database_connection');

        // creando sql 

        $sql = "select 
                lp.nombre as NOMBRE_LENGUAJE, 
                COUNT(DISTINCT pref.programador_id) as CANTIDAD_PROGRAMADORES,
                COUNT(DISTINCT proy.id) as CANTIDAD_PROYECTOS

                FROM samples_programadores__lenguaje_programacion as lp
                LEFT JOIN samples_programadores__lenguajes_preferidos as pref ON lp.id=pref.lenguaje_programacion_id
                LEFT JOIN samples_programadores__proyecto as proy on lp.id=proy.lenguaje_programacion_id

                GROUP BY lp.id
                ORDER BY lp.nombre"
        ;

        // ejecutando la consulta

        $lenguajes = $conn->fetchAll($sql);

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesProgramadoresBundle:Programador')
                ->createQueryBuilder('p')
                ->orderBy('p.nombre', 'ASC')
                ->addOrderBy('p.apellido1', 'ASC')
                ->addOrderBy('p.apellido2', 'ASC');

        $query = $queryBuilder->getQuery();

        $programadores = $query->getResult();

        return $this->render('SamplesProgramadoresBundle:Reporte:tablas.html.twig', array('lenguajes' => $lenguajes,
                    'programadores' => $programadores));
    }

    /**
     * @Route("/ejemplo-2-view-pdf", name="samples_programadores_reporte_ejemplo_2_pdf_view")
     */
    public function ejemplo2PdfviewAction() {

        $conn = $this->get('database_connection');

        // creando sql 

        $sql = "select 
                lp.nombre as NOMBRE_LENGUAJE, 
                COUNT(DISTINCT pref.programador_id) as CANTIDAD_PROGRAMADORES,
                COUNT(DISTINCT proy.id) as CANTIDAD_PROYECTOS

                FROM samples_programadores__lenguaje_programacion as lp
                LEFT JOIN samples_programadores__lenguajes_preferidos as pref ON lp.id=pref.lenguaje_programacion_id
                LEFT JOIN samples_programadores__proyecto as proy on lp.id=proy.lenguaje_programacion_id

                GROUP BY lp.id
                ORDER BY lp.nombre"
        ;

        // ejecutando la consulta

        $lenguajes = $conn->fetchAll($sql);

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesProgramadoresBundle:Programador')
                ->createQueryBuilder('p')
                ->orderBy('p.nombre', 'ASC')
                ->addOrderBy('p.apellido1', 'ASC')
                ->addOrderBy('p.apellido2', 'ASC');

        $query = $queryBuilder->getQuery();

        $programadores = $query->getResult();

        return $this->getPdfExporter()->render('SamplesProgramadoresBundle:Reporte:tablas.pdf.twig', array('lenguajes' => $lenguajes,
                    'programadores' => $programadores));
    }

    /**
     * @Route("/ejemplo-2-download-pdf", name="samples_programadores_reporte_ejemplo_2_pdf_download")
     */
    public function ejemplo2PdfDownloadAction() {

        $conn = $this->get('database_connection');

        // creando sql 

        $sql = "select 
                lp.nombre as NOMBRE_LENGUAJE, 
                COUNT(DISTINCT pref.programador_id) as CANTIDAD_PROGRAMADORES,
                COUNT(DISTINCT proy.id) as CANTIDAD_PROYECTOS

                FROM samples_programadores__lenguaje_programacion as lp
                LEFT JOIN samples_programadores__lenguajes_preferidos as pref ON lp.id=pref.lenguaje_programacion_id
                LEFT JOIN samples_programadores__proyecto as proy on lp.id=proy.lenguaje_programacion_id

                GROUP BY lp.id
                ORDER BY lp.nombre"
        ;

        // ejecutando la consulta

        $lenguajes = $conn->fetchAll($sql);

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesProgramadoresBundle:Programador')
                ->createQueryBuilder('p')
                ->orderBy('p.nombre', 'ASC')
                ->addOrderBy('p.apellido1', 'ASC')
                ->addOrderBy('p.apellido2', 'ASC');

        $query = $queryBuilder->getQuery();

        $programadores = $query->getResult();

        return $this->getPdfExporter()->attach('SamplesProgramadoresBundle:Reporte:tablas.pdf.twig', 
                array('lenguajes' => $lenguajes,'programadores' => $programadores), // datos para rellenar el pdf
                "Reportes de Lenguajes y Programadores", // titulo del pdf
                "Letter" // tipo de papel "Letter", "A4", etc.
                );
    }

    /**
     * @return \UtilBundle\Exporter\PdfExporter
     */
    public function getPdfExporter() {
        return $this->container->get("samples.util.exporter.pdf");
    }

    /**
     * @Route("/ejemplo-3-chart", name="samples_programadores_reporte_ejemplo_3")
     */
    public function ejemplo3ChartsAction() {

        $conn = $this->get('database_connection');

        // creando sql 

        $sql = "select 
                lp.nombre as NOMBRE_LENGUAJE, 
                COUNT(DISTINCT pref.programador_id) as CANTIDAD_PROGRAMADORES,
                COUNT(DISTINCT proy.id) as CANTIDAD_PROYECTOS

                FROM samples_programadores__lenguaje_programacion as lp
                LEFT JOIN samples_programadores__lenguajes_preferidos as pref ON lp.id=pref.lenguaje_programacion_id
                LEFT JOIN samples_programadores__proyecto as proy on lp.id=proy.lenguaje_programacion_id

                GROUP BY lp.id
                ORDER BY lp.nombre"
        ;

        // ejecutando la consulta

        $lenguajes = $conn->fetchAll($sql);

        $queryBuilder = $this->getDoctrine()->getRepository('SamplesProgramadoresBundle:Programador')
                ->createQueryBuilder('p')
                ->orderBy('p.nombre', 'ASC')
                ->addOrderBy('p.apellido1', 'ASC')
                ->addOrderBy('p.apellido2', 'ASC');

        $query = $queryBuilder->getQuery();

        $programadores = $query->getResult();
        
        return $this->render('SamplesProgramadoresBundle:Reporte:graficas.html.twig',
                array('lenguajes' => $lenguajes, 'programadores' => $programadores));
    }

    
}
