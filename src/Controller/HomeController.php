<?php
namespace App\Controller;

use App\Entity\Imagem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $form = $this->createFormBuilder()
            ->add("foto",FileType::class)
            ->setAction("/enviaImagem")
            ->getForm();

        return $this->render('index.html.twig',["form" => $form->createView()]);
    }

    /**
     * @Route("/enviaImagem",methods="POST")
     */
    public function enviaImagemAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add("foto",FileType::class)
            ->setAction("/enviaImagem")
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()){
            $arquivo = $form->getData()["foto"];
            $nomeDoArquivo = $arquivo->getClientOriginalName();

            $destino = $this->getParameter("kernel.project_dir")."/public/uploads/img";

            $arquivo->move($destino, $nomeDoArquivo);

            $imagem = new Imagem();
            $imagem->setCaminho($destino."/".$nomeDoArquivo);

            $em = $this->getDoctrine()->getManager();
            $em->persist($imagem);
            $em->flush();
        }

        // redireciona para a index
        return $this->redirect("/");
    }
}
