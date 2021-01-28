<?php
namespace App\Controller\Front;
use App\Entity\Article;
use App\Entity\Rate;
use App\Form\ArticleType;
use App\Form\RateType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/front/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('front/article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/", name="article_index")
     */
    public function indexfront(ArticleRepository $articleRepository): Response
    {
        return $this->render('front/article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }    
    
       /**
     * @Route("/{id}", name="article_showFront", methods={"GET"})
     */   
    public function show(article $article, ArticleRepository $articleRepository ): Response
    {   
        
        $article = $articleRepository->findOneBy(
            
            ['id' => $article->getId()],
            
        );
        
        return $this->render('front/article/show.html.twig', [
            // 'category' => $category,
            'id' => $article,
        ]);
    }
}