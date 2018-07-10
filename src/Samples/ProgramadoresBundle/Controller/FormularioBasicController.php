<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Programador controller.
 *
 * @Route("/form/basic")
 */
class FormularioBasicController extends Controller {

    /**
     * @Route("/insertar-form-1", name="samples_programadores_formulario_insertar_form_1")
     */
    public function insertarProgramadorFormluario1Action() {
        return $this->render('SamplesProgramadoresBundle:Formulario:Basic/insertar-programador-form-1.html.twig');
    }

    /**
     * @Route("/insertar-form-2", name="samples_programadores_formulario_insertar_form_2")
     */
    public function insertarProgramadorFormluario2Action() {

        $sistemas_operativos = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:SistemaOperativo")->findAll();

        $lenguajes_programacion = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:LenguajeProgramacion")->findAll();

        return $this->render('SamplesProgramadoresBundle:Formulario:Basic/insertar-programador-form-2.html.twig', array(
                    "sistemas_operativos" => $sistemas_operativos,
                    "lenguajes_programacion" => $lenguajes_programacion
                        )
        );
    }

    /**
     * @Route("/insertar-form-3", name="samples_programadores_formulario_insertar_form_3")
     */
    public function insertarProgramadorFormluario3Action() {

        $sistemas_operativos = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:SistemaOperativo")->findAll();

        $lenguajes_programacion = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:LenguajeProgramacion")->findAll();

        return $this->render('SamplesProgramadoresBundle:Formulario:Basic/insertar-programador-form-3.html.twig', array(
                    "sistemas_operativos" => $sistemas_operativos,
                    "lenguajes_programacion" => $lenguajes_programacion
                        )
        );
    }

    /**
     * @Route("/insertar-form-4", name="samples_programadores_formulario_insertar_form_4")
     */
    public function insertarProgramadorFormluario4Action() {

        $request = $this->getRequest();

        $method = $request->getMethod();

        if ($method == "GET") {
            $sistemas_operativos = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:SistemaOperativo")->findAll();

            $lenguajes_programacion = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:LenguajeProgramacion")->findAll();

            return $this->render('SamplesProgramadoresBundle:Formulario:Basic/insertar-programador-form-4-a.html.twig', array(
                        "sistemas_operativos" => $sistemas_operativos,
                        "lenguajes_programacion" => $lenguajes_programacion
                            )
            );
        } else if ($method == "POST") {

            // obteniendo los valores que vienen por POST

            $nombre = $request->request->get('nombre');
            $sexo = $request->request->get('sexo');
            $certificado = $request->request->get('certificado');
            $sistema_id = $request->request->get('sistema');
            $lenguajes_ids = $request->request->get('lenguajes_programacion');

            $programador = new \Samples\ProgramadoresBundle\Entity\Programador();

            $programador->setNombre($nombre);
            $programador->setSexo($sexo);
            $programador->setCertificado($certificado);
            $programador->setSistemaOperativo($this->getDoctrine()->getRepository("SamplesProgramadoresBundle:SistemaOperativo")->find($sistema_id));

            foreach ($lenguajes_ids as $i => $lenguaje_id) {
                $programador->addLenguajesProgramacion($this->getDoctrine()->getRepository("SamplesProgramadoresBundle:LenguajeProgramacion")->find($lenguaje_id));
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($programador);
            $em->flush();

            return $this->render('SamplesProgramadoresBundle:Formulario:Basic/insertar-programador-form-4-b.html.twig', array(
                        "programador" => $programador
            ));
        } else {
            throw new \Exception("método http no permitido");
        }
    }

    /**
     * @Route("/insertar-form-5", name="samples_programadores_formulario_insertar_form_5")
     */
    public function insertarProgramadorFormluario5Action() {

        $request = $this->getRequest();

        $method = $request->getMethod();

        if ($method == "GET") {
            $sistemas_operativos = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:SistemaOperativo")->findAll();

            $lenguajes_programacion = $this->getDoctrine()->getRepository("SamplesProgramadoresBundle:LenguajeProgramacion")->findAll();

            return $this->render('SamplesProgramadoresBundle:Formulario:Basic/insertar-programador-form-5-a.html.twig', array(
                        "sistemas_operativos" => $sistemas_operativos,
                        "lenguajes_programacion" => $lenguajes_programacion
                            )
            );
        } else if ($method == "POST") {

            // obteniendo los valores que vienen por POST

            $programador_data = $request->request->get('programador');

            $programador = new \Samples\ProgramadoresBundle\Entity\Programador();

            $programador->setNombre($programador_data['nombre']);
            $programador->setSexo($programador_data['sexo']);
            $programador->setCertificado($programador_data['certificado']);
            $programador->setSistemaOperativo($this->getDoctrine()->getRepository("SamplesProgramadoresBundle:SistemaOperativo")->find($programador_data['sistema_operativo']));

            foreach ($programador_data['lenguajes_programacion'] as $i => $lenguaje_id) {
                $programador->addLenguajesProgramacion($this->getDoctrine()->getRepository("SamplesProgramadoresBundle:LenguajeProgramacion")->find($lenguaje_id));
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($programador);
            $em->flush();

            return $this->render('SamplesProgramadoresBundle:Formulario:Basic/insertar-programador-form-5-b.html.twig', array(
                        "programador" => $programador
            ));
        } else {
            throw new \Exception("método http no permitido");
        }
    }

}
