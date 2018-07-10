<?php

namespace Samples\IndexBundle\Exporter;

use Symfony\Component\HttpFoundation\Response;

class PdfExporter {

    private $templateEngine;

    public function __construct($templateEngine) {
        $this->templateEngine = $templateEngine;
    }

    private function create_pdf_from_html($html, $page_size = "A4") {

        require_once(dirname(__FILE__) . '/../Resources/html2pdf/html2pdf.class.php');

        //$pdf = new \HTML2PDF('P', 'mm', 'Letter'); // el tercer parametro indica el tamaño de hoja A4, Letter
        //$pdf = new \HTML2PDF('P', 'pt', 'A4'); // el tercer parametro indica el tamaño de hoja A4, Letter

        //$html2pdf = new \HTML2PDF('P', $page_size, 'es', true, 'UTF-8', 0);
        $html2pdf = new \HTML2PDF('P', $page_size, 'en', true, 'UTF-8', 0);
        $html2pdf->writeHTML($html);

        $output = $html2pdf->Output('', 'S'); //retornarlo como un buffer String

        return $output;
    }

    public function renderA4($viewname, $params = array()) {
        return $this->render($viewname, $params, "A4");
    }

    public function renderLetter($viewname, $params = array()) {
        return $this->render($viewname, $params, "Letter");
    }

    public function render($viewname, $params = array(), $page_size = "A4") {

        $html = $this->getTemplateEngine()->render($viewname, $params);

        $output = $this->create_pdf_from_html($html, $page_size);

        return new Response(
                $output, 200, array(
				'Content-Type' => 'application/pdf',
                // 'Content-Disposition' => 'attachment; filename="reporte.pdf"'
                )
        );
    }

    public function attachA4($viewname, $params = array(), $title = "file") {
        return $this->attach($viewname, $params, $title, "A4");
    }

    public function attachLetter($viewname, $params= array(), $title = "file") {
        return $this->render($viewname, $params, $title, "Letter");
    }

    public function attach($viewname, $params = array(), $title = "file", $page_size = "A4") {

        $html = $this->getTemplateEngine()->render($viewname, $params);

        $output = $this->create_pdf_from_html($html, $page_size);

        return new Response(
                $output, 200, array(
				'Content-Type' => 'application/pdf',
				'Content-Disposition' => 'attachment; filename="' . $title . '.pdf"'
                )
        );
    }

    /**
     * @return \Symfony\Bundle\TwigBundle\TwigEngine
     */
    public function getTemplateEngine() {
        return $this->templateEngine;
    }

}
