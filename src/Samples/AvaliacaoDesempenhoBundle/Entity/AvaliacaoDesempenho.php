<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avaliacao
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__avaliacaodesempenho")
 * @ORM\Entity
 */
class AvaliacaoDesempenho {

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
     * @ORM\JoinColumn(name="pessoal_id", referencedColumnName="id", nullable=false)
     */
    private $pessoal;

    /**
     * @ORM\ManyToMany(targetEntity="TipoDecisao")
     * @ORM\JoinTable(name="samples_avaliacao_desempenho__avaliacaodesempenho_tipodecisao", 
     *           joinColumns={@ORM\JoinColumn(name="avaliacao_desempenho_id", referencedColumnName="id")},
     *           inverseJoinColumns={@ORM\JoinColumn(name="tipo_decisao_id",referencedColumnName="id")})
     */
    protected $decisoes_do_conselho_pedagogico;

    /**
     * @ORM\OneToMany(targetEntity="DisciplinaLecionada", mappedBy="avaliacao_desempenho",cascade={"all"})
     */
    protected $disciplinas_lecionadas;

    /**
     * @ORM\ManyToOne(targetEntity="AnoLectivo")
     * @ORM\JoinColumn(name="ano_lectivo_id", referencedColumnName="id", nullable=false)
     */
    private $ano_lectivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date")
     */
    private $data;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_01", type="integer")
     */
    private $fichaItem01;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_02", type="integer")
     */
    private $fichaItem02;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_03", type="integer")
     */
    private $fichaItem03;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_04", type="integer")
     */
    private $fichaItem04;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_05", type="integer")
     */
    private $fichaItem05;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_06", type="integer")
     */
    private $fichaItem06;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_07", type="integer")
     */
    private $fichaItem07;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_08", type="integer")
     */
    private $fichaItem08;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_09", type="integer")
     */
    private $fichaItem09;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_10", type="integer")
     */
    private $fichaItem10;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_11", type="integer")
     */
    private $fichaItem11;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_12", type="integer")
     */
    private $fichaItem12;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_13", type="integer")
     */
    private $fichaItem13;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_14", type="integer")
     */
    private $fichaItem14;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_15", type="integer")
     */
    private $fichaItem15;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_16", type="integer")
     */
    private $fichaItem16;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_17", type="integer")
     */
    private $fichaItem17;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_18", type="integer")
     */
    private $fichaItem18;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_19", type="integer")
     */
    private $fichaItem19;

    /**
     * @var integer
     *
     * @ORM\Column(name="ficha_item_20", type="integer")
     */
    private $fichaItem20;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado", type="text", nullable=true)
     */
    private $resultado;

    /**
     * @var float
     *
     * @ORM\Column(name="pontuacao", type="float", nullable=true)
     */
    private $pontuacao;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     * @return Avaliacao
     */
    public function setData($data) {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Set fichaItem01
     *
     * @param integer $fichaItem01
     * @return Avaliacao
     */
    public function setFichaItem01($fichaItem01) {
        $this->fichaItem01 = $fichaItem01;

        return $this;
    }

    /**
     * Get fichaItem01
     *
     * @return integer 
     */
    public function getFichaItem01() {
        return $this->fichaItem01;
    }

    /**
     * Set fichaItem02
     *
     * @param integer $fichaItem02
     * @return Avaliacao
     */
    public function setFichaItem02($fichaItem02) {
        $this->fichaItem02 = $fichaItem02;

        return $this;
    }

    /**
     * Get fichaItem02
     *
     * @return integer 
     */
    public function getFichaItem02() {
        return $this->fichaItem02;
    }

    /**
     * Set fichaItem03
     *
     * @param integer $fichaItem03
     * @return Avaliacao
     */
    public function setFichaItem03($fichaItem03) {
        $this->fichaItem03 = $fichaItem03;

        return $this;
    }

    /**
     * Get fichaItem03
     *
     * @return integer 
     */
    public function getFichaItem03() {
        return $this->fichaItem03;
    }

    /**
     * Set fichaItem04
     *
     * @param integer $fichaItem04
     * @return Avaliacao
     */
    public function setFichaItem04($fichaItem04) {
        $this->fichaItem04 = $fichaItem04;

        return $this;
    }

    /**
     * Get fichaItem04
     *
     * @return integer 
     */
    public function getFichaItem04() {
        return $this->fichaItem04;
    }

    /**
     * Set fichaItem05
     *
     * @param integer $fichaItem05
     * @return Avaliacao
     */
    public function setFichaItem05($fichaItem05) {
        $this->fichaItem05 = $fichaItem05;

        return $this;
    }

    /**
     * Get fichaItem05
     *
     * @return integer 
     */
    public function getFichaItem05() {
        return $this->fichaItem05;
    }

    /**
     * Set fichaItem06
     *
     * @param integer $fichaItem06
     * @return Avaliacao
     */
    public function setFichaItem06($fichaItem06) {
        $this->fichaItem06 = $fichaItem06;

        return $this;
    }

    /**
     * Get fichaItem06
     *
     * @return integer 
     */
    public function getFichaItem06() {
        return $this->fichaItem06;
    }

    /**
     * Set fichaItem07
     *
     * @param integer $fichaItem07
     * @return Avaliacao
     */
    public function setFichaItem07($fichaItem07) {
        $this->fichaItem07 = $fichaItem07;

        return $this;
    }

    /**
     * Get fichaItem07
     *
     * @return integer 
     */
    public function getFichaItem07() {
        return $this->fichaItem07;
    }

    /**
     * Set fichaItem08
     *
     * @param integer $fichaItem08
     * @return Avaliacao
     */
    public function setFichaItem08($fichaItem08) {
        $this->fichaItem08 = $fichaItem08;

        return $this;
    }

    /**
     * Get fichaItem08
     *
     * @return integer 
     */
    public function getFichaItem08() {
        return $this->fichaItem08;
    }

    /**
     * Set fichaItem09
     *
     * @param integer $fichaItem09
     * @return Avaliacao
     */
    public function setFichaItem09($fichaItem09) {
        $this->fichaItem09 = $fichaItem09;

        return $this;
    }

    /**
     * Get fichaItem09
     *
     * @return integer 
     */
    public function getFichaItem09() {
        return $this->fichaItem09;
    }

    /**
     * Set fichaItem10
     *
     * @param integer $fichaItem10
     * @return Avaliacao
     */
    public function setFichaItem10($fichaItem10) {
        $this->fichaItem10 = $fichaItem10;

        return $this;
    }

    /**
     * Get fichaItem10
     *
     * @return integer 
     */
    public function getFichaItem10() {
        return $this->fichaItem10;
    }

    /**
     * Set fichaItem11
     *
     * @param integer $fichaItem11
     * @return Avaliacao
     */
    public function setFichaItem11($fichaItem11) {
        $this->fichaItem11 = $fichaItem11;

        return $this;
    }

    /**
     * Get fichaItem11
     *
     * @return integer 
     */
    public function getFichaItem11() {
        return $this->fichaItem11;
    }

    /**
     * Set fichaItem12
     *
     * @param integer $fichaItem12
     * @return Avaliacao
     */
    public function setFichaItem12($fichaItem12) {
        $this->fichaItem12 = $fichaItem12;

        return $this;
    }

    /**
     * Get fichaItem12
     *
     * @return integer 
     */
    public function getFichaItem12() {
        return $this->fichaItem12;
    }

    /**
     * Set fichaItem13
     *
     * @param integer $fichaItem13
     * @return Avaliacao
     */
    public function setFichaItem13($fichaItem13) {
        $this->fichaItem13 = $fichaItem13;

        return $this;
    }

    /**
     * Get fichaItem13
     *
     * @return integer 
     */
    public function getFichaItem13() {
        return $this->fichaItem13;
    }

    /**
     * Set fichaItem14
     *
     * @param integer $fichaItem14
     * @return Avaliacao
     */
    public function setFichaItem14($fichaItem14) {
        $this->fichaItem14 = $fichaItem14;

        return $this;
    }

    /**
     * Get fichaItem14
     *
     * @return integer 
     */
    public function getFichaItem14() {
        return $this->fichaItem14;
    }

    /**
     * Set fichaItem15
     *
     * @param integer $fichaItem15
     * @return Avaliacao
     */
    public function setFichaItem15($fichaItem15) {
        $this->fichaItem15 = $fichaItem15;

        return $this;
    }

    /**
     * Get fichaItem15
     *
     * @return integer 
     */
    public function getFichaItem15() {
        return $this->fichaItem15;
    }

    /**
     * Set fichaItem16
     *
     * @param integer $fichaItem16
     * @return Avaliacao
     */
    public function setFichaItem16($fichaItem16) {
        $this->fichaItem16 = $fichaItem16;

        return $this;
    }

    /**
     * Get fichaItem16
     *
     * @return integer 
     */
    public function getFichaItem16() {
        return $this->fichaItem16;
    }

    /**
     * Set fichaItem17
     *
     * @param integer $fichaItem17
     * @return Avaliacao
     */
    public function setFichaItem17($fichaItem17) {
        $this->fichaItem17 = $fichaItem17;

        return $this;
    }

    /**
     * Get fichaItem17
     *
     * @return integer 
     */
    public function getFichaItem17() {
        return $this->fichaItem17;
    }

    /**
     * Set fichaItem18
     *
     * @param integer $fichaItem18
     * @return Avaliacao
     */
    public function setFichaItem18($fichaItem18) {
        $this->fichaItem18 = $fichaItem18;

        return $this;
    }

    /**
     * Get fichaItem18
     *
     * @return integer 
     */
    public function getFichaItem18() {
        return $this->fichaItem18;
    }

    /**
     * Set fichaItem19
     *
     * @param integer $fichaItem19
     * @return Avaliacao
     */
    public function setFichaItem19($fichaItem19) {
        $this->fichaItem19 = $fichaItem19;

        return $this;
    }

    /**
     * Get fichaItem19
     *
     * @return integer 
     */
    public function getFichaItem19() {
        return $this->fichaItem19;
    }

    /**
     * Set fichaItem20
     *
     * @param integer $fichaItem20
     * @return Avaliacao
     */
    public function setFichaItem20($fichaItem20) {
        $this->fichaItem20 = $fichaItem20;

        return $this;
    }

    /**
     * Get fichaItem20
     *
     * @return integer 
     */
    public function getFichaItem20() {
        return $this->fichaItem20;
    }

    /**
     * Set resultado
     *
     * @param string $resultado
     * @return Avaliacao
     */
    public function setResultado($resultado) {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string 
     */
    public function getResultado() {
        return $this->resultado;
    }

    /**
     * Set pontuacao
     *
     * @param float $pontuacao
     * @return Avaliacao
     */
    public function setPontuacao($pontuacao) {
        $this->pontuacao = $pontuacao;

        return $this;
    }

    /**
     * Get pontuacao
     *
     * @return float 
     */
    public function getPontuacao() {
        return $this->pontuacao;
    }

    public function getClassificacao() {

        if (!$this->pontuacao || $this->pontuacao <= 7) {
            return "Mau";
        } else if ($this->pontuacao <= 9) {
            return "Medíocre";
        } else if ($this->pontuacao <= 13) {
            return "Suficiente";
        } else if ($this->pontuacao <= 15) {
            return "Bom";
        } else if ($this->pontuacao <= 17) {
            return "Muito Bom";
        }
        return "Excelente";
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->decisoes_do_conselho_pedagogico = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set pessoal
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal $pessoal
     * @return AvaliacaoDesempenho
     */
    public function setPessoal(\Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal $pessoal) {
        $this->pessoal = $pessoal;

        return $this;
    }

    /**
     * Get pessoal
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal 
     */
    public function getPessoal() {
        return $this->pessoal;
    }

    /**
     * Add decisoes_do_conselho_pedagogico
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\TipoDecisao $decisoesDoConselhoPedagogico
     * @return AvaliacaoDesempenho
     */
    public function addDecisoesDoConselhoPedagogico(\Samples\AvaliacaoDesempenhoBundle\Entity\TipoDecisao $decisoesDoConselhoPedagogico) {
        $this->decisoes_do_conselho_pedagogico[] = $decisoesDoConselhoPedagogico;

        return $this;
    }

    /**
     * Remove decisoes_do_conselho_pedagogico
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\TipoDecisao $decisoesDoConselhoPedagogico
     */
    public function removeDecisoesDoConselhoPedagogico(\Samples\AvaliacaoDesempenhoBundle\Entity\TipoDecisao $decisoesDoConselhoPedagogico) {
        $this->decisoes_do_conselho_pedagogico->removeElement($decisoesDoConselhoPedagogico);
    }

    /**
     * Get decisoes_do_conselho_pedagogico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDecisoesDoConselhoPedagogico() {
        return $this->decisoes_do_conselho_pedagogico;
    }

    /**
     * Set ano_lectivo
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\AnoLectivo $anoLectivo
     * @return AvaliacaoDesempenho
     */
    public function setAnoLectivo(\Samples\AvaliacaoDesempenhoBundle\Entity\AnoLectivo $anoLectivo) {
        $this->ano_lectivo = $anoLectivo;

        return $this;
    }

    /**
     * Get ano_lectivo
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\AnoLectivo 
     */
    public function getAnoLectivo() {
        return $this->ano_lectivo;
    }

    public function __toString() {
        return $this->id ? $this->pessoal->getNome() . " (" . $this->ano_lectivo->getAno() . ")" : "";
    }

    /**
     * Add disciplinas_lecionadas
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\DisciplinaLecionada $disciplinasLecionadas
     * @return AvaliacaoDesempenho
     */
    public function addDisciplinasLecionada(\Samples\AvaliacaoDesempenhoBundle\Entity\DisciplinaLecionada $disciplinasLecionadas) {
        $this->disciplinas_lecionadas[] = $disciplinasLecionadas;

        return $this;
    }

    /**
     * Remove disciplinas_lecionadas
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\DisciplinaLecionada $disciplinasLecionadas
     */
    public function removeDisciplinasLecionada(\Samples\AvaliacaoDesempenhoBundle\Entity\DisciplinaLecionada $disciplinasLecionadas) {
        $this->disciplinas_lecionadas->removeElement($disciplinasLecionadas);
    }

    /**
     * Get disciplinas_lecionadas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDisciplinasLecionadas() {
        return $this->disciplinas_lecionadas;
    }

}
