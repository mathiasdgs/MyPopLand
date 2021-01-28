<?php

namespace App\Controller;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository; 
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;   
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

      /**
     * @Route("/", name="home")
     */
    public function indexAction(ArticleRepository $articleRepository, CategoryRepository $categoryRepository) 
    {
         $articles = $articleRepository->findBy([],['created_at' => 'DESC'],4 );
         $categories = $categoryRepository->findBy([],[],4 );
     
         return $this->render('default/index.html.twig', [
         'articles' => $articles,
         'categories' => $categories,
     ]);
         
    }

       /**
         * @Route("/admin/macollection", name="macollection")
         * @return Response
        */
    public function macollectionAction()
    {
         return $this->render('admin/macollection.html.twig');
    }
     
      /**
         * @Route("/admin/moncompte", name="moncompte")
         * @return Response
        */
        public function moncompteAction()
        {
             return $this->render('admin/moncompte.html.twig');
        }
}
