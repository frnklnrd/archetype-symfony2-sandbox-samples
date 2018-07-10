<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicacao
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__participacaoproducaocientifica")
 * @ORM\Entity
 */
class ParticipacaoProducaoCientifica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoal")
     * @ORM\JoinColumn(name="pessoal_id", referencedColumnName="id")
     */
    protected $pessoal;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoProducaoCientifica")
     * @ORM\JoinColumn(name="tipo_producao_cientifica_id", referencedColumnName="id")
     */
    protected $tipo_producao_cientifica;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date")
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="tema", type="string", length=255, nullable=true)
     */
    private $tema;

    /**
     * @var string
     *
     * @ORM\Column(name="nacional_internacional", type="string", length=255, nullable=true)
     */
    private $nacional_internacional;

    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="text", nullable=true)
     */
    private $observacoes;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return ParticipacaoProducaoCientifica
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set tema
     *
     * @param string $tema
     * @return ParticipacaoProducaoCientifica
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string 
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set nacional_internacional
     *
     * @param string $nacionalInternacional
     * @return ParticipacaoProducaoCientifica
     */
    public function setNacionalInternacional($nacionalInternacional)
    {
        $this->nacional_internacional = $nacionalInternacional;

        return $this;
    }

    /**
     * Get nacional_internacional
     *
     * @return string 
     */
    public function getNacionalInternacional()
    {
        return $this->nacional_internacional;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     * @return ParticipacaoProducaoCientifica
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string 
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Set pessoal
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal $pessoal
     * @return ParticipacaoProducaoCientifica
     */
    public function setPessoal(\Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal $pessoal = null)
    {
        $this->pessoal = $pessoal;

        return $this;
    }

    /**
     * Get pessoal
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal 
     */
    public function getPessoal()
    {
        return $this->pessoal;
    }

    /**
     * Set tipo_producao_cientifica
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\TipoProducaoCientifica $tipoProducaoCientifica
     * @return ParticipacaoProducaoCientifica
     */
    public function setTipoProducaoCientifica(\Samples\AvaliacaoDesempenhoBundle\Entity\TipoProducaoCientifica $tipoProducaoCientifica = null)
    {
        $this->tipo_producao_cientifica = $tipoProducaoCientifica;

        return $this;
    }

    /**
     * Get tipo_producao_cientifica
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\TipoProducaoCientifica 
     */
    public function getTipoProducaoCientifica()
    {
        return $this->tipo_producao_cientifica;
    }
}
