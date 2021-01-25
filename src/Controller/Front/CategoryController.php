<?php

namespace App\Controller\Front;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
     * @Route("/front/category")
     */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="category_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('front/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
  /**
     * @Route("/{id}", name="category_showFront", methods={"GET"})
     */
    public function show(category $category, ArticleRepository $articleRepository ): Response
    {
        $articles = $articleRepository->findBy(
            ['category' => $category->getId()],
            ['created_at' => 'DESC'],

        );

        return $this->render('front/category/show.html.twig', [
            'category' => $category,
            'articles' => $articles
        ]);
    }

    


    /**
     * @Route("/", name="category_showFront")
     */
    public function indexcatfront(CategoryRepository $categoryRepository): Response
    {
        return $this->render('front/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
      
    

}
