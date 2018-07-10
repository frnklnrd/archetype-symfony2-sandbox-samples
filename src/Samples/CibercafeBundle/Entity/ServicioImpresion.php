<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio_impresion")
 */
class ServicioImpresion extends Servicio {

    /**
     * @ORM\Column(name="texto", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="No debe estar vac�o")
     */
    private $texto;

    /**
     * @ORM\ManyToOne(targetEntity="TipoImpresion", inversedBy="ServicioImpresion")
     * @ORM\JoinColumn(name="tipoimpresion_id", referencedColumnName="id", nullable=false)
     */
    private $tipo_imp;

    /**
     * Set texto
     *
     * @param string $texto
     * @return ServicioImpresion
     */
    public function setTexto($texto) {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto() {
        return $this->texto;
    }

    /**
     * Set tipo_imp
     *
     * @param \Samples\CibercafeBundle\Entity\TipoImpresion $tipoImp
     * @return ServicioImpresion
     */
    public function setTipoImp(\Samples\CibercafeBundle\Entity\TipoImpresion $tipoImp) {
        $this->tipo_imp = $tipoImp;

        return $this;
    }

    /**
     * Get tipo_imp
     *
     * @return \Samples\CibercafeBundle\Entity\TipoImpresion 
     */
    public function getTipoImp() {
        return $this->tipo_imp;
    }

    public function getPrecio() {

        $palabras = preg_split("/[\s,]+/", $this->texto);
        $cantidad = count($palabras);

        if ($this->usuario instanceof UsuarioAsociado && $this->usuario->getCategoria()->getId() == 1) {
            return $cantidad * 1.5;
        } else {
            return $cantidad * (1.5 + $this->tipo_imp->getId());
        }
    }

    public function getTipo() {
        return "Impresión";
    }
}