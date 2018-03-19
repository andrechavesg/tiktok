<?php
namespace App\Controller;

use App\Entity\Funcionario;
use App\Entity\HoraLancada;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HoraLancadaController extends Controller
{
    /**
     * @Route("/horaLancada/mostra",methods="GET")
     */
    public function mostraAction()
    {
        return $this->render('HoraLancada/mostra.html.twig',["horaLancada" => new HoraLancada()]);
    }

    /**
     * @Route("/horaLancada/novo",methods="GET")
     */
    public function formulario()
    {
        $form = $this->createFormBuilder(new HoraLancada())
            ->add('descricao')
            ->add('quantidade')
            ->add('funcionario')
            ->add('projeto')
            ->setAction('/horaLancada/novo')
            ->getForm();

        return $this->render("HoraLancada/novo.html.twig",["form" => $form->createView()]);
    }

    /**
     * @Route("/horaLancada/novo",methods="POST")
     */
    public function cria(Request $request)
    {
        $projeto = new HoraLancada();

        $form = $this->createFormBuilder($projeto)
            ->add('descricao')
            ->add('quantidade')
            ->add('funcionario')
            ->add('projeto')
            ->getForm();

        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($projeto);
        $em->flush();

        return $this->redirect("/horaLancada/lista");
    }

    /**
     * @Route("/horaLancada/lista",methods="GET")
     */
    public function lista()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(HoraLancada::class);

        return $this->render("HoraLancada/lista.html.twig",["horasLancadas" => $repository->findAll()]);
    }

    /**
     * @Route("/horaLancada/edita/{id}",methods="GET")
     */
    public function mostra(HoraLancada $horaLancada)
    {
        $form = $this->createFormBuilder($horaLancada)
            ->add('descricao')
            ->add('quantidade')
            ->add('funcionario')
            ->add('projeto')
            ->setAction("/horaLancada/edita/".$horaLancada->getId())
            ->setMethod("POST")
            ->getForm();

        return $this->render('HoraLancada/edita.html.twig',["horaLancada" => $horaLancada,"form" => $form->createView()]);
    }

    /**
     * @Route("/horaLancada/edita/{id}",methods="POST")
     */
    public function edita(HoraLancada $horaLancada, Request $request)
    {
        $form = $this->createFormBuilder($horaLancada)
            ->add('descricao')
            ->add('quantidade')
            ->add('funcionario')
            ->add('projeto')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $horaLancada = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->merge($horaLancada);
            $em->flush();

            return $this->redirect("/horaLancada/edita/".$horaLancada->getId());
        }

        return $this->render('HoraLancada/edita.html.twig',["horaLancada" => $horaLancada]);
    }

    /**
     * @Route("/horaLancada/remove/{id}",methods="GET")
     */
    public function delete(HoraLancada $projeto)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($projeto);
        $em->flush();

        return $this->redirect("/horaLancada/lista");
    }
}
