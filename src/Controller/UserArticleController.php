<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/u_article")
 */
class UserArticleController extends AbstractController
{
    /**
     * @Route("/allArticles", name="u_allarticles")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('user_articles/index.html.twig', [
             'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="u_article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('user_articles/u_show.html.twig', [
            'article' => $article,
        ]);
    }
}
