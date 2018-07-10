<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/basicos")
 */
class BasicController extends Controller {

    /**
     * @Route("/ejemplo-1", name="samples_programadores_basic_ejemplo_1")
     */
    public function ejemplo1Action() {
        return new Response("<table><thead><th>NOMBRE</th><th>EDAD</th></thead><tbody><tr><td>Pepe</td><td>25</td></tr><tr><td>Ana</td><td>18</td></tr></tbody></table>");
    }

    /**
     * @Route("/ejemplo-2", name="samples_programadores_basic_ejemplo_2")
     */
    public function ejemplo2Action() {
        
        $html = "<table>
                    <thead>
                        <th>NOMBRE</th>
                        <th>EDAD</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Pepe</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>Ana</td>
                            <td>18</td>
                        </tr>
                    </tbody>
                 </table>";

        return new Response($html);
    }

    /**
     * @Route("/ejemplo-3", name="samples_programadores_basic_ejemplo_3")
     */
    public function ejemplo3Action() {
        
        $html = $this->renderView('SamplesProgramadoresBundle:Basic:static-table.html.twig', array());

        return new Response($html);
    }

    /**
     * @Route("/ejemplo-4", name="samples_programadores_basic_ejemplo_4")
     */
    public function ejemplo4Action() {
        return $this->render('SamplesProgramadoresBundle:Basic:static-table.html.twig', array());
    }

}
