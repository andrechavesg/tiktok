<?php
namespace App\Controller;

use App\Entity\Funcionario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends Controller
{
    /**
     * @Route("/funcionario/mostra/{id}")
     */
    public function mostraAction(Funcionario $funcionario)
    {
        return $this->render('Funcionario/mostra.html.twig',["funcionario" => $funcionario]);
    }

    /**
     * @Route("/funcionario/novo",methods="GET")
     */
    public function formulario()
    {
        return $this->render("Funcionario/novo.html.twig");
    }

    /**
     * @Route("/funcionario/novo",methods="POST")
     */
    public function cria(Request $request)
    {
        $nome = $request->get("nome");
        $dataDeNascimento = new \DateTime($request->get("dataDeNascimento"));

        $funcionario = new Funcionario();
        $funcionario->setNome($nome);
        $funcionario->setDataDeNascimento($dataDeNascimento);
        $funcionario->setDataDeEntrada(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($funcionario);
        $em->flush();

        return $this->redirect("/funcionario/mostra/".$funcionario->getNome());
    }
}
