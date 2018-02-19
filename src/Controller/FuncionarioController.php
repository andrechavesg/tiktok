<?php
namespace App\Controller;

use App\Entity\Funcionario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends Controller
{
    /**
     * @Route("/funcionario/mostra/{nome}")
     */
    public function mostraAction($nome)
    {
        $funcionario = new Funcionario();

        $funcionario->setNome($nome);
        $funcionario->setDataDeNascimento(new \DateTime("26-01-1994"));
        $funcionario->setDataDeEntrada(new \DateTime("21-03-2012"));

        return $this->render('Funcionario/mostra.html.twig',["funcionario" => $funcionario]);
    }
}
