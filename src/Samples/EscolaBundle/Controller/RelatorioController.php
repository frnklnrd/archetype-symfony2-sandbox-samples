<?php

namespace Samples\EscolaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/escola/relatorios")
 */
class RelatorioController extends \Sonata\AdminBundle\Controller\CoreController {

    /**
     * @Route("/estudantes-cursos-pesquisas.html", name="samples_escola_relatorio_estudantes")
     */
    public function EstudantesCursosPesquisasAction(Request $request) {

        $conn = $this->get('database_connection');

        $sql = "SELECT DISTINCT 
					e.nome as nome, 
					c.nome as curso,
					COUNT(p.id) as quantidade_pesquisas
                FROM samples_escola__estudante as e
					LEFT JOIN samples_escola__curso as c ON c.id=e.curso_id
					LEFT JOIN samples_escola__pesquisa as p ON p.estudante_id = e.id
                GROUP BY e.id
				ORDER BY e.nome";

        $result = $conn->fetchAll($sql);

        return $this->render('SamplesEscolaBundle:Relatorio:estudantes.html.twig', array('result' => $result,
                    'base_template' => $this->getBaseTemplate($request),
                    'admin_pool' => $this->container->get('sonata.admin.pool')
                        )
        );
    }

    /**
     * @Route("/estudantes-cursos-pesquisas.pdf", name="samples_escola_relatorio_estudantes_pdf")
     */
    public function EstudantesCursosPesquisasPDFAction(Request $request) {

        $conn = $this->get('database_connection');

        $sql = "SELECT DISTINCT 
					e.nome as nome, 
					c.nome as curso,
					COUNT(p.id) as quantidade_pesquisas
                FROM samples_escola__estudante as e
					LEFT JOIN samples_escola__curso as c ON c.id=e.curso_id
					LEFT JOIN samples_escola__pesquisa as p ON p.estudante_id = e.id
                GROUP BY e.id
				ORDER BY e.nome";

        $result = $conn->fetchAll($sql);

        return $this->container->get("util.exporter.pdf")
                        ->attach('SamplesEscolaBundle:Relatorio:estudantes.pdf.twig', array('result' => $result), "Relatorio de Estudantes e Pesquisas", "A4"
        );
    }

    /**
     * @Route("/cursos-estudantes.html", name="samples_escola_relatorio_cursos_graficos")
     */
    public function CursosEstudantesGraficosAction(Request $request) {

        $conn = $this->get('database_connection');

        $sql = "SELECT DISTINCT  
					c.nome as curso,
					COUNT(e.id) as quantidade_estudantes
                FROM samples_escola__curso as c
					LEFT JOIN samples_escola__estudante as e ON c.id=e.curso_id
                GROUP BY c.id
				ORDER BY c.nome";

        $result = $conn->fetchAll($sql);

        return $this->render('SamplesEscolaBundle:Relatorio:cursos.html.twig', array('result' => $result,
                    'base_template' => $this->getBaseTemplate($request),
                    'admin_pool' => $this->container->get('sonata.admin.pool')
                        )
        );
    }

}
