<?php

namespace Samples\ProgramadoresBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Samples\ProgramadoresBundle\Entity\Programador;
use Samples\ProgramadoresBundle\Form\ProgramadorType;

/**
 * @Route("/ajax/programador")
 */
class ProgramadorAjaxController extends Controller {

    /**
     * @Route("/load-ajax-samples", name="samples_programadores_ajax_index")
     */
    public function indexAction() {
        return $this->render('SamplesProgramadoresBundle:Ajax:index.html.twig', array());
    }

    /**
     * @Route("/list", name="samples_programadores_ajax_lista_programadores", options={"expose"=true})
     */
    public function listAction() {
        $programadores = $this->getDoctrine()
                ->getRepository("SamplesProgramadoresBundle:Programador")
                ->findAll();

        return $this->render('SamplesProgramadoresBundle:Ajax:list.html.twig', array("programadores" => $programadores));
    }

    /**
     * @Route("/new", name="samples_programadores_ajax_adicionar_programador", options={"expose"=true})
     */
    public function newAction() {

        $request = $this->getRequest(); //$this->get('request'); // obtenemos el objeto request

        $method = $request->getMethod(); // obtenemos si método de la petición si fue por GET o POST

        $entity = new Programador();
        $form = $this->createForm(new ProgramadorType(), $entity);

        if ($method == "POST") {

            $form->bind($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'Programador insertado satisfactoriamente');
                return new Response("OK");
            }
        }

        return $this->render('SamplesProgramadoresBundle:Ajax:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/find", name="samples_programadores_ajax_buscar_programadores", options={"expose"=true})
     */
    public function findAction() {

        $request = $this->getRequest(); //$this->get('request'); // obtenemos el objeto request

        $nombre = $request->request->get("nombre");

        if (!$nombre) {
            return $this->render('SamplesProgramadoresBundle:Ajax:find.html.twig');
        } else {
            $programadores = $this->getDoctrine()
                            ->getRepository("SamplesProgramadoresBundle:Programador")
                            ->createQueryBuilder("p")
                            ->where("p.nombre LIKE :nombre")
                            ->setParameter("nombre", "%" . $nombre . "%")
                            ->getQuery()->getResult();

            $programadoresJSON = array();

            foreach ($programadores as $i => $programador) {
                $programadorJSON = array();
                $programadorJSON["id"] = $programador->getId();
                $programadorJSON["nombre"] = $programador->getNombreCompleto();
                $programadorJSON["sistema"] = $programador->getSistemaOperativo()->getNombre();
                $programadorJSON["lenguajes"] = join(", ", $programador->getLenguajesProgramacion()->toArray());

                array_push($programadoresJSON, $programadorJSON);
            }

            $response = new Response(json_encode(array("programadores" => $programadoresJSON)));
            $response->headers->set("Content-Type", "application/json");
            return $response;
        }
    }

    /**
     * @Route("/add-multiple", name="samples_programadores_ajax_multiple_adicionar_programador", options={"expose"=true})
     * @Template()
     */
    public function addMultipleAction() {

        $request = $this->getRequest(); //$this->get('request'); // obtenemos el objeto request

        $method = $request->getMethod(); // obtenemos si método de la petición si fue por GET o POST

        if ($method == "GET") {

            $entity = new Programador();
            $form = $this->createForm(new ProgramadorType(), $entity);

            return $this->render('SamplesProgramadoresBundle:Ajax:add-multiple.html.twig', array(
                        'entity' => $entity,
                        'form' => $form->createView(),
            ));
        } else {
            $request = $this->get('request');

            $programadoresJSON = json_decode($request->request->get("programadores"));

            $em = $this->getDoctrine()->getEntityManager();

            foreach ($programadoresJSON as $programadorData) {

                $programador = new Programador();

                $programador->setCi($programadorData->{"ci"});
                $programador->setNombre($programadorData->{"nombre"});
                $programador->setApellido1($programadorData->{"apellido1"});
                $programador->setApellido2($programadorData->{"apellido2"});
                $programador->setFechaNacimiento(date_create($programadorData->{"fecha_nacimiento"}));
                $programador->setSexo($programadorData->{"sexo"});
                $programador->setNombre($programadorData->{"nombre"});
                $programador->setCertificado($programadorData->{"certificado"});
                $programador->setSistemaOperativo($this->getDoctrine()
                                ->getRepository("SamplesProgramadoresBundle:SistemaOperativo")->findOneById($programadorData->{"sistema_id"}));

                $lenguajes_ids = $programadorData->{"lenguajes_ids"};

                foreach ($lenguajes_ids as $lenguaje_id) {
                    $programador->addLenguajesProgramacion($this->getDoctrine()
                                    ->getRepository("SamplesProgramadoresBundle:LenguajeProgramacion")->findOneById($lenguaje_id));
                }

                $em->persist($programador);
            }

            $em->flush();

            return new Response('OK');
        }
        return new Response('');
    }

}
