<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([], ['id' => 'DESC']);
        $archives = $this->getDoctrine()->getRepository(Article::class)->findBy([], ['id' => 'ASC'],3);
        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
            'articles' => $articles,
            'archives' => $archives
        ]);
    }
}