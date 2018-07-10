<?php

namespace Samples\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Medicamento
 *
 * @ORM\Table(name="samples_farmacia__medicamento")
 * @ORM\Entity
 */
class Medicamento extends Produto {

    /**
     * @var float
     *
     * @ORM\Column(name="dosagem", type="float")
     */
    private $dosagem;

    /**
     * @ORM\ManyToMany(targetEntity="PrincipioActivo")
     * @ORM\JoinTable(name="samples_farmacia__medicamento_principio_activo",
     *           joinColumns={@ORM\JoinColumn(name="medicamento_id", referencedColumnName="id")},
     *           inverseJoinColumns={@ORM\JoinColumn(name="principio_activo_id",referencedColumnName="id")})
     */
    private $principios_activos;

    /**
     * @ORM\ManyToOne(targetEntity="UnidadeMedida")
     * @ORM\JoinColumn(name="unidade_medida_id", referencedColumnName="id")
     */
    private $unidade_de_medida;

    /**
     * @ORM\ManyToOne(targetEntity="Forma")
     * @ORM\JoinColumn(name="forma_id", referencedColumnName="id")
     */
    private $forma;

    public function __toString() {
        return $this->id ? $this->nome . "( " . $this->getTipo() . " )" . " [ " . $this->stock . " no stock ]" : "";
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->principios_activos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set dosagem
     *
     * @param float $dosagem
     * @return Medicamento
     */
    public function setDosagem($dosagem) {
        $this->dosagem = $dosagem;

        return $this;
    }

    /**
     * Get dosagem
     *
     * @return float 
     */
    public function getDosagem() {
        return $this->dosagem;
    }

    /**
     * Get dosagem
     *
     * @return float 
     */
    public function getDosagemUM() {
        return $this->dosagem . " " . $this->unidade_de_medida;
    }

    /**
     * Add principios_activos
     *
     * @param \Samples\FarmaciaBundle\Entity\PrincipioActivo $principiosActivos
     * @return Medicamento
     */
    public function addPrincipiosActivo(\Samples\FarmaciaBundle\Entity\PrincipioActivo $principiosActivos) {
        $this->principios_activos[] = $principiosActivos;

        return $this;
    }

    /**
     * Remove principios_activos
     *
     * @param \Samples\FarmaciaBundle\Entity\PrincipioActivo $principiosActivos
     */
    public function removePrincipiosActivo(\Samples\FarmaciaBundle\Entity\PrincipioActivo $principiosActivos) {
        $this->principios_activos->removeElement($principiosActivos);
    }

    /**
     * Get principios_activos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrincipiosActivos() {
        return $this->principios_activos;
    }

    /**
     * Set unidade_de_medida
     *
     * @param \Samples\FarmaciaBundle\Entity\UnidadeMedida $unidadeDeMedida
     * @return Medicamento
     */
    public function setUnidadeDeMedida(\Samples\FarmaciaBundle\Entity\UnidadeMedida $unidadeDeMedida = null) {
        $this->unidade_de_medida = $unidadeDeMedida;

        return $this;
    }

    /**
     * Get unidade_de_medida
     *
     * @return \Samples\FarmaciaBundle\Entity\UnidadeMedida 
     */
    public function getUnidadeDeMedida() {
        return $this->unidade_de_medida;
    }

    /**
     * Set forma
     *
     * @param \Samples\FarmaciaBundle\Entity\Forma $forma
     * @return Medicamento
     */
    public function setForma(\Samples\FarmaciaBundle\Entity\Forma $forma = null) {
        $this->forma = $forma;

        return $this;
    }

    /**
     * Get forma
     *
     * @return \Samples\FarmaciaBundle\Entity\Forma 
     */
    public function getForma() {
        return $this->forma;
    }

}
