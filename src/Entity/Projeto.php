<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Projeto
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
     * @ORM\OneToMany(targetEntity="Funcionario", mappedBy="projeto")
     */
    private $funcionarios;

    /**
     * @ORM\OneToMany(targetEntity="HoraLancada", mappedBy="projeto")
     */
    private $horasLancadas;

    public function __construct()
    {
        $this->funcionarios = new ArrayCollection();
        $this->horasLancadas = new ArrayCollection();
    }

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
    public function getFuncionarios()
    {
        return $this->funcionarios;
    }

    /**
     * @param mixed $funcionarios
     */
    public function setFuncionarios($funcionarios)
    {
        $this->funcionarios = $funcionarios;
    }

    public function addFuncionario(Funcionario $funcionario)
    {
        $funcionario->setProjeto($this);
        $this->funcionarios->add($funcionario);
    }

    public function removeFuncionario(Funcionario $funcionario)
    {
        $funcionario->setProjeto(null);
        $this->funcionarios->remove($funcionario);
    }

    /**
     * @return mixed
     */
    public function getHorasLancadas()
    {
        return $this->horasLancadas;
    }

    public function getTotalHorasLancadas()
    {
        $horas = 0;
        foreach($this->horasLancadas as $horasLancada){
            $horas += $horasLancada->getQuantidade();
        }

        return $horas;
    }

    /**
     * @param mixed $horasLancadas
     */
    public function setHorasLancadas($horasLancadas)
    {
        $this->horasLancadas = $horasLancadas;
    }

    public function addHorasLancada(HoraLancada $hora)
    {
        $this->horasLancadas->add($hora);
    }

    public function removeHorasLancada(HoraLancada $hora)
    {
        $this->horasLancadas->remove($hora);
    }

    public function __toString()
    {
        return $this->getNome();
    }
}
