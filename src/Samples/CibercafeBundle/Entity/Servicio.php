<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio")
 * 
 *  //configuracion de la herencia
 * 
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="tipo_servicio", type="string")
 * @ORM\DiscriminatorMap({
 *                          "quemado" = "ServicioQuemado",
 *                          "impresion" = "ServicioImpresion",
 *                          "cafeteria" = "ServicioCafeteria",
 *                          "navegacion" = "ServicioNavegacion",
 *                          "reservacion_salon_conferencia" = "ServicioReservacionSalonConferencia",
 *                          "reservacion_laboratorio" = "ServicioReservacionLaboratorio",
 * })
 */
abstract class Servicio {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="hora_inicio", type="time", nullable=true)
     */
    protected $hora_inicio;

    /**
     * @ORM\Column(name="hora_fin", type="time", nullable=true)
     */
    protected $hora_fin;

    /**
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    protected $usuario;

    public function __toString() {
        return $this->getTipo() . " - " . $this->getUsuario();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set hora_inicio
     *
     * @param \DateTime $horaInicio
     * @return Servicio
     */
    public function setHoraInicio($horaInicio) {
        $this->hora_inicio = $horaInicio;

        return $this;
    }

    /**
     * Get hora_inicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio() {
        return $this->hora_inicio;
    }

    /**
     * Set hora_fin
     *
     * @param \DateTime $horaFin
     * @return Servicio
     */
    public function setHoraFin($horaFin) {
        $this->hora_fin = $horaFin;

        return $this;
    }

    /**
     * Get hora_fin
     *
     * @return \DateTime 
     */
    public function getHoraFin() {
        return $this->hora_fin;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Servicio
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set usuario
     *
     * @param \Samples\CibercafeBundle\Entity\Usuario $usuario
     * @return Servicio
     */
    public function setUsuario(\Samples\CibercafeBundle\Entity\Usuario $usuario) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Samples\CibercafeBundle\Entity\Usuario 
     */
    public function getUsuario() {
        return $this->usuario;
    }

    public function getPrecio() {
        return 0;
    }

    public function getTipo() {
        // return substr(get_class($this), strrpos(get_class($this), "\\") + 1); // devuelve el nombre de la clase
        return "Servicio";
    }

}