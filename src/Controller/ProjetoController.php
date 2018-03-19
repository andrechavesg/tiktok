<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Entity\Projeto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjetoController extends Controller
{
    /**
     * @Route("/projeto/mostra",methods="GET")
     */
    public function mostraAction()
    {
        return $this->render('Projeto/mostra.html.twig',["projeto" => new Projeto()]);
    }

    /**
     * @Route("/projeto/novo",methods="GET")
     */
    public function formulario()
    {
        $form = $this->createFormBuilder(new Projeto())
            ->add('nome')
            ->setAction('/projeto/novo')
            ->getForm();

        return $this->render("Projeto/novo.html.twig",["form" => $form->createView()]);
    }

    /**
     * @Route("/projeto/novo",methods="POST")
     */
    public function cria(Request $request)
    {
        $projeto = new Projeto();

        $form = $this->createFormBuilder($projeto)
            ->add('nome')
            ->getForm();

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projeto);
        $em->flush();

        return $this->redirect("/projeto/lista");
    }

    /**
     * @Route("/projeto/lista",methods="GET")
     */
    public function lista()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Projeto::class);

        return $this->render("Projeto/lista.html.twig",["projetos" => $repository->findAll()]);
    }

    /**
     * @Route("/projeto/edita/{id}",methods="GET")
     */
    public function mostra(Projeto $projeto)
    {
        $form = $this->createFormBuilder($projeto)
            ->add('nome')
            ->add('funcionarios')
            ->setAction("/projeto/edita/".$projeto->getId())
            ->getForm();

        return $this->render('Projeto/edita.html.twig',["projeto" => $projeto,"form" => $form->createView()]);
    }

    /**
     * @Route("/projeto/edita/{id}",methods="POST")
     */
    public function edita(Projeto $projeto, Request $request)
    {
        $form = $this->createFormBuilder($projeto)
            ->add('nome')
            ->add('funcionarios')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $projeto = $form->getData();

            $em = $this->getDoctrine()->getManager();

            foreach($projeto->getFuncionarios() as $funcionario){
                $funcionario->setProjeto($projeto);
                $em->merge($funcionario);
            }

            $em->merge($projeto);
            $em->flush();

            return $this->redirect("/projeto/edita/".$projeto->getId());
        }

        return $this->render('Projeto/edita.html.twig',["projeto" => $projeto]);
    }

    /**
     * @Route("/projeto/remove/{id}",methods="GET")
     */
    public function delete(Projeto $projeto)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($projeto);
        $em->flush();

        return $this->redirect("/projeto/lista");
    }
}
