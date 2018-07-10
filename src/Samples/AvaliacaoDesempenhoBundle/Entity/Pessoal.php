<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pessoa
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__pessoal")
 * @ORM\Entity
 */
class Pessoal
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="bi", type="string", length=255)
     */
    private $bi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_nacimento", type="date")
     */
    private $data_nacimento;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=255)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=255)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_agente", type="string", length=255)
     */
    private $numero_agente;

    /**
     * @var string
     *
     * @ORM\Column(name="parcial_integral", type="string", length=255)
     */
    private $parcial_integral;

    /**
     * @var float
     *
     * @ORM\Column(name="media_geral_licenciatura", type="float")
     */
    private $media_geral_licenciatura;

    /**
     * @ORM\OneToOne(targetEntity="\Sonata\UserBundle\Entity\BaseUser", cascade={"all"})
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=true)
     */
    private $usuario;
    
    /**
     * @ORM\ManyToOne(targetEntity="Departamento")
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     */
    protected $departamento;

    /**
     * @ORM\OneToMany(targetEntity="CategoriaProfissionalObtida", mappedBy="pessoal",cascade={"all"})
     */
    protected $categorias_profissionais;
    
    /**
     * @ORM\OneToMany(targetEntity="GrauAcademicoObtido", mappedBy="pessoal",cascade={"all"})
     */
    protected $graus_academicos;
    
    /**
     * @ORM\OneToMany(targetEntity="ParticipacaoActividade", mappedBy="pessoal",cascade={"all"})
     */
    protected $actividades;
    
    /**
     * @ORM\OneToMany(targetEntity="ParticipacaoProducaoCientifica", mappedBy="pessoal",cascade={"all"})
     */
    protected $producoes_cientificas;    
    
    /**
     * @ORM\OneToMany(targetEntity="AvaliacaoDesempenho", mappedBy="pessoal",cascade={"all"})
     */
    protected $avaliacoes_desempenho; 
    
    public function __toString() {
        return $this->id?$this->nome:"";
    }

    public function getCategoriaProfissional()
    {
        if ($this->categorias_profissionais && !$this->categorias_profissionais->isEmpty())
        {
            return $this->categorias_profissionais->last()->getCategoriaProfissional()->getCategoria();
        }
        return "";
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorias_profissionais = new \Doctrine\Common\Collections\ArrayCollection();
        $this->graus_academicos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actividades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->producoes_cientificas = new \Doctrine\Common\Collections\ArrayCollection();
        $this->avaliacoes_desempenho = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set nome
     *
     * @param string $nome
     * @return Pessoal
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set bi
     *
     * @param string $bi
     * @return Pessoal
     */
    public function setBi($bi)
    {
        $this->bi = $bi;

        return $this;
    }

    /**
     * Get bi
     *
     * @return string 
     */
    public function getBi()
    {
        return $this->bi;
    }

    /**
     * Set data_nacimento
     *
     * @param \DateTime $dataNacimento
     * @return Pessoal
     */
    public function setDataNacimento($dataNacimento)
    {
        $this->data_nacimento = $dataNacimento;

        return $this;
    }

    /**
     * Get data_nacimento
     *
     * @return \DateTime 
     */
    public function getDataNacimento()
    {
        return $this->data_nacimento;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     * @return Pessoal
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string 
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return Pessoal
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set numero_agente
     *
     * @param string $numeroAgente
     * @return Pessoal
     */
    public function setNumeroAgente($numeroAgente)
    {
        $this->numero_agente = $numeroAgente;

        return $this;
    }

    /**
     * Get numero_agente
     *
     * @return string 
     */
    public function getNumeroAgente()
    {
        return $this->numero_agente;
    }

    /**
     * Set parcial_integral
     *
     * @param string $parcialIntegral
     * @return Pessoal
     */
    public function setParcialIntegral($parcialIntegral)
    {
        $this->parcial_integral = $parcialIntegral;

        return $this;
    }

    /**
     * Get parcial_integral
     *
     * @return string 
     */
    public function getParcialIntegral()
    {
        return $this->parcial_integral;
    }

    /**
     * Set media_geral_licenciatura
     *
     * @param float $mediaGeralLicenciatura
     * @return Pessoal
     */
    public function setMediaGeralLicenciatura($mediaGeralLicenciatura)
    {
        $this->media_geral_licenciatura = $mediaGeralLicenciatura;

        return $this;
    }

    /**
     * Get media_geral_licenciatura
     *
     * @return float 
     */
    public function getMediaGeralLicenciatura()
    {
        return $this->media_geral_licenciatura;
    }

    /**
     * Set usuario
     *
     * @param \Sonata\UserBundle\Entity\BaseUser $usuario
     * @return Pessoal
     */
    public function setUsuario(\Sonata\UserBundle\Entity\BaseUser $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Sonata\UserBundle\Entity\BaseUser 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set departamento
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\Departamento $departamento
     * @return Pessoal
     */
    public function setDepartamento(\Samples\AvaliacaoDesempenhoBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\Departamento 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Add categorias_profissionais
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\CategoriaProfissionalObtida $categoriasProfissionais
     * @return Pessoal
     */
    public function addCategoriasProfissionai(\Samples\AvaliacaoDesempenhoBundle\Entity\CategoriaProfissionalObtida $categoriasProfissionais)
    {
        $this->categorias_profissionais[] = $categoriasProfissionais;

        return $this;
    }

    /**
     * Remove categorias_profissionais
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\CategoriaProfissionalObtida $categoriasProfissionais
     */
    public function removeCategoriasProfissionai(\Samples\AvaliacaoDesempenhoBundle\Entity\CategoriaProfissionalObtida $categoriasProfissionais)
    {
        $this->categorias_profissionais->removeElement($categoriasProfissionais);
    }

    /**
     * Get categorias_profissionais
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategoriasProfissionais()
    {
        return $this->categorias_profissionais;
    }

    /**
     * Add graus_academicos
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\GrauAcademicoObtido $grausAcademicos
     * @return Pessoal
     */
    public function addGrausAcademico(\Samples\AvaliacaoDesempenhoBundle\Entity\GrauAcademicoObtido $grausAcademicos)
    {
        $this->graus_academicos[] = $grausAcademicos;

        return $this;
    }

    /**
     * Remove graus_academicos
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\GrauAcademicoObtido $grausAcademicos
     */
    public function removeGrausAcademico(\Samples\AvaliacaoDesempenhoBundle\Entity\GrauAcademicoObtido $grausAcademicos)
    {
        $this->graus_academicos->removeElement($grausAcademicos);
    }

    /**
     * Get graus_academicos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrausAcademicos()
    {
        return $this->graus_academicos;
    }

    /**
     * Add actividades
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoActividade $actividades
     * @return Pessoal
     */
    public function addActividade(\Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoActividade $actividades)
    {
        $this->actividades[] = $actividades;

        return $this;
    }

    /**
     * Remove actividades
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoActividade $actividades
     */
    public function removeActividade(\Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoActividade $actividades)
    {
        $this->actividades->removeElement($actividades);
    }

    /**
     * Get actividades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getActividades()
    {
        return $this->actividades;
    }

    /**
     * Add producoes_cientificas
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoProducaoCientifica $producoesCientificas
     * @return Pessoal
     */
    public function addProducoesCientifica(\Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoProducaoCientifica $producoesCientificas)
    {
        $this->producoes_cientificas[] = $producoesCientificas;

        return $this;
    }

    /**
     * Remove producoes_cientificas
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoProducaoCientifica $producoesCientificas
     */
    public function removeProducoesCientifica(\Samples\AvaliacaoDesempenhoBundle\Entity\ParticipacaoProducaoCientifica $producoesCientificas)
    {
        $this->producoes_cientificas->removeElement($producoesCientificas);
    }

    /**
     * Get producoes_cientificas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducoesCientificas()
    {
        return $this->producoes_cientificas;
    }

    /**
     * Add avaliacoes_desempenho
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\AvaliacaoDesempenho $avaliacoesDesempenho
     * @return Pessoal
     */
    public function addAvaliacoesDesempenho(\Samples\AvaliacaoDesempenhoBundle\Entity\AvaliacaoDesempenho $avaliacoesDesempenho)
    {
        $this->avaliacoes_desempenho[] = $avaliacoesDesempenho;

        return $this;
    }

    /**
     * Remove avaliacoes_desempenho
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\AvaliacaoDesempenho $avaliacoesDesempenho
     */
    public function removeAvaliacoesDesempenho(\Samples\AvaliacaoDesempenhoBundle\Entity\AvaliacaoDesempenho $avaliacoesDesempenho)
    {
        $this->avaliacoes_desempenho->removeElement($avaliacoesDesempenho);
    }

    /**
     * Get avaliacoes_desempenho
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAvaliacoesDesempenho()
    {
        return $this->avaliacoes_desempenho;
    }
}
