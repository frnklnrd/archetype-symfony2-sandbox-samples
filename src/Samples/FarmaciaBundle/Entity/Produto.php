<?php

namespace Samples\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="samples_farmacia__produto")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="tipo_produto", type="string")
 * @ORM\DiscriminatorMap({"medicamento" = "Medicamento", "dispositivo_medico" = "DispositivoMedico"})
 */
abstract class Produto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    protected $nome;

    /**
     * @var float
     *
     * @ORM\Column(name="stock", type="float", nullable=true)
     */
    protected $stock;

    public function __toString() {
        return $this->id ? $this->nome . "( " . $this->getTipo() . " )" . " [ " . $this->stock . " no stock ]" : "";
    }

    public function getTipo() {
        return substr(get_class($this), strrpos(get_class($this), "\\") + 1) == "Medicamento" ? "Medicamento" : "Dispositivo Médico";
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
     * Set nome
     *
     * @param string $nome
     * @return Produto
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set stock
     *
     * @param float $stock
     * @return Produto
     */
    public function setStock($stock) {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return float 
     */
    public function getStock() {
        return $this->stock;
    }

}
