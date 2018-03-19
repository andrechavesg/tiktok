<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class HoraLancada
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
    private $descricao;

    /**
     * @ORM\Column(type="float")
     */
    private $quantidade;

    /**
     * @ORM\ManyToOne(targetEntity="Funcionario", inversedBy="horasLancadas")
     */
    private $funcionario;

    /**
     * @ORM\ManyToOne(targetEntity="Projeto", inversedBy="horasLancadas")
     */
    private $projeto;

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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $quantidade
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    /**
     * @return mixed
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * @param mixed $funcionario
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
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
}
