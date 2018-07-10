<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__usuario")
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="asociado_o_ventual", type="string")
 * @ORM\DiscriminatorMap({"asociado" = "UsuarioAsociado", "eventual" = "UsuarioEventual"})
 *
 * @UniqueEntity(fields={"carnet_identidad"})
 * @UniqueEntity(fields={"num_PC_asignada"}, message="Esta PC ya está asignada")
 * @UniqueEntity(fields={"nombre", "apellidos"})
 * @UniqueEntity(fields={"num_tarjeta_credito"})
 */
abstract class Usuario {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    protected $nombre;

    /**
     * @ORM\Column(name="apellidos", type="string", length=20, nullable=false)
     */
    protected $apellidos;

    /**
     * @ORM\Column(name="num_PC_asignada", type="integer", nullable=false)
      * @Assert\NotBlank(message="No debe estar vacio")     * 
     */
    protected $num_PC_asignada;

    /**
     * @ORM\Column(name="num_tarjeta_credito", type="string", nullable=false)
     */
    protected $num_tarjeta_credito;

    /**
     * @ORM\Column(type="string", length=11, unique=true, nullable=false )
     * @Assert\NotBlank(message="No debe estar vacio")
     * @Assert\Regex(pattern="/\w/", match=true, message="Debe contener solo numeros")
     * @Assert\Length(min=11, max=11, exactMessage="Debe estar formado por {{ limit }} digitos")
     */
    protected $carnet_identidad;

   /**
     * @ORM\OneToMany(targetEntity="Servicio", mappedBy="usuario")
     */
    protected $servicios;
   
    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->servicios = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos() {
        return $this->apellidos;
    }

    /**
     * Set num_PC_asignada
     *
     * @param integer $numPCAsignada
     * @return Usuario
     */
    public function setNumPCAsignada($numPCAsignada) {
        $this->num_PC_asignada = $numPCAsignada;

        return $this;
    }

    /**
     * Get num_PC_asignada
     *
     * @return integer 
     */
    public function getNumPCAsignada() {
        return $this->num_PC_asignada;
    }

    /**
     * Set num_tarjeta_credito
     *
     * @param string $numTarjetaCredito
     * @return Usuario
     */
    public function setNumTarjetaCredito($numTarjetaCredito) {
        $this->num_tarjeta_credito = $numTarjetaCredito;

        return $this;
    }

    /**
     * Get num_tarjeta_credito
     *
     * @return string 
     */
    public function getNumTarjetaCredito() {
        return $this->num_tarjeta_credito;
    }

    /**
     * Set carnet_identidad
     *
     * @param string $carnetIdentidad
     * @return Usuario
     */
    public function setCarnetIdentidad($carnetIdentidad) {
        $this->carnet_identidad = $carnetIdentidad;

        return $this;
    }

    /**
     * Get carnet_identidad
     *
     * @return string 
     */
    public function getCarnetIdentidad() {
        return $this->carnet_identidad;
    }

    /**
     * Add servicios
     *
     * @param \Samples\CibercafeBundle\Entity\Servicio $servicios
     * @return Usuario
     */
    public function addServicio(\Samples\CibercafeBundle\Entity\Servicio $servicios) {
        $this->servicios[] = $servicios;

        return $this;
    }

    /**
     * Remove servicios
     *
     * @param \Samples\CibercafeBundle\Entity\Servicio $servicios
     */
    public function removeServicio(\Samples\CibercafeBundle\Entity\Servicio $servicios) {
        $this->servicios->removeElement($servicios);
    }

    /**
     * Get servicios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServicios() {
        return $this->servicios;
    }

    public function getTipo() {
        //return substr(get_class($this), strrpos(get_class($this), "\\") + 1);
        return "Usuario";
    }    
}