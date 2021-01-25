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
    public function index(): Response
    {
        return $this->render('front/category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/", name="category_indexFront", methods={"GET"})
     */
    public function indexfront(CategoryRepository $categoryRepository): Response
    {
        return $this->render('front_office/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

}
