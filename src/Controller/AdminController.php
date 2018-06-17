<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdminController extends Controller
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                [],
                ['id' => 'DESC']
            );
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'articles' => $articles
        ]);
    }


    /**
     * @Route("/admin/delete/{id}", name="delete_article")
     * Method({DELETE})
     */
    public function delete($id) {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $image = $article->getImage();
        $file = new Filesystem();

        try {
            $file->remove($image);
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your directory at ".$exception->getPath();
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();

        $response = new Response();
        return $response->send();
    }


    /**
     * @Route("/admin/new", name="new_article")
     * Method({"GET", "POST"})
     */
    public function newArticle(Request $request) {
        $article = new Article();

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array(
                'label' => 'Tytuł artykułu',
                'attr' => array('class' => 'form-control')))

            ->add('article_body', TextareaType::class, array(
                'label' => 'Treść artykułu',
                'attr' => array('class' => 'form-control')))

            ->add('image', FileType::class, array(
                'label' => 'Zdjęcie artykułu',
                'attr' => array('class' => 'form-control')))

            ->add('save', SubmitType::class, array(
                'label' => 'Dodaj',
                'attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();

            $file = $article->getImage();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );

            $article->setImage('images/'.$fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('/admin/new.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/admin/update/{id}", name="update_article")
     * Method({"GET", "POST"})
     */
    public function updateArticle(Request $request, $id) {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $image = $article->getImage();
        $article->setImage(new File($image));

        $form = $this->createFormBuilder($article)
            ->add('title', TextType::class, array(
                'label' => 'Tytuł artykułu',
                'attr' => array('class' => 'form-control')))

            ->add('article_body', TextareaType::class, array(
                'label' => 'Treść artykułu',
                'attr' => array('class' => 'form-control')))

            ->add('image', FileType::class, array(
                'required' => false,
                'label' => 'Zdjęcie artykułu',
                'attr' => array('class' => 'form-control')))

            ->add('save', SubmitType::class, array(
                'label' => 'Dodaj',
                'attr' => array('class' => 'btn btn-primary')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!empty($article->getImage())) {
                $imageToRemove = new Filesystem();

                try {
                    $imageToRemove->remove($image);
                } catch (IOExceptionInterface $exception) {
                    echo "Wystąpił błąd przy próbie usunięcia obrazu w miejscu: ".$exception->getPath();
                }

                $imageToUpload = $article->getImage();
                $imageName = $this->generateUniqueFileName().'.'.$imageToUpload->guessExtension();
                $imageToUpload->move($this->getParameter('brochures_directory'), $imageName);
                $article->setImage('images/'.$imageName);
            } else {
                $article->setImage($image);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('/admin/update.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}
