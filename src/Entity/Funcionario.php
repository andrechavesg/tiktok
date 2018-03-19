<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Funcionario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDeNascimento;
    /**
     * @ORM\Column(type="datetime")
     */
    private $dataDeEntrada;

    /**
     * @ORM\ManyToOne(targetEntity="Projeto", inversedBy="funcionarios")
     */
    private $projeto;

    /**
     * @ORM\OneToMany(targetEntity="HoraLancada", mappedBy="funcionario")
     */
    private $horasLancadas;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getDataDeNascimento()
    {
        return $this->dataDeNascimento;
    }

    /**
     * @param mixed $dataDeNascimento
     */
    public function setDataDeNascimento($dataDeNascimento)
    {
        $this->dataDeNascimento = $dataDeNascimento;
    }

    /**
     * @return mixed
     */
    public function getDataDeEntrada()
    {
        return $this->dataDeEntrada;
    }

    /**
     * @param mixed $dataDeEntrada
     */
    public function setDataDeEntrada($dataDeEntrada)
    {
        $this->dataDeEntrada = $dataDeEntrada;
    }

    /**
     * @return mixed
     */
    public function getProjeto()
    {
        return $this->projeto;
    }

    /**
     * @param mixed $projeto
     */
    public function setProjeto($projeto)
    {
        $this->projeto = $projeto;
    }

    /**
     * @return mixed
     */
    public function getHorasLancadas()
    {
        return $this->horasLancadas;
    }

    /**
     * @param mixed $horasLancadas
     */
    public function setHorasLancadas($horasLancadas)
    {
        $this->horasLancadas = $horasLancadas;
    }

    public function getTempoNaEmpresa()
    {
        $hoje = new \DateTime();
        $diferenca = $hoje->diff($this->dataDeEntrada);

        return $diferenca;
    }

    public function __toString()
    {
        return $this->getNome();
    }
}
