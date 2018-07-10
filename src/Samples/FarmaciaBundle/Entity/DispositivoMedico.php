<?php

namespace Samples\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DispositivoMedico
 *
 * @ORM\Table(name="samples_farmacia__dispositivomedico")
 * @ORM\Entity
 */
class DispositivoMedico extends Produto
{
    /**
     * @ORM\ManyToOne(targetEntity="Classificacao")
     * @ORM\JoinColumn(name="forma_id", referencedColumnName="id")
     */
    private $classificacao;

	public function __toString()
	{
		return $this->id?$this->nome."( ".$this->getTipo()." )"." [ ".$this->stock." no stock ]":"";
	}
    /**
     * Set classificacao
     *
     * @param \Samples\FarmaciaBundle\Entity\Classificacao $classificacao
     * @return DispositivoMedico
     */
    public function setClassificacao(\Samples\FarmaciaBundle\Entity\Classificacao $classificacao = null)
    {
        $this->classificacao = $classificacao;

        return $this;
    }

    /**
     * Get classificacao
     *
     * @return \Samples\FarmaciaBundle\Entity\Classificacao 
     */
    public function getClassificacao()
    {
        return $this->classificacao;
    }
}
