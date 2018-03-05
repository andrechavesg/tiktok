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

    // getters e setters

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

    public function getTempoNaEmpresa()
    {
        $hoje = new \DateTime();
        $diferenca = $hoje->diff($this->dataDeEntrada);

        return $diferenca;
    }
}
