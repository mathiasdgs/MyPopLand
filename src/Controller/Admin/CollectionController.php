<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
    /**
     * @Route("/admin/collection")
     */
class CollectionController extends AbstractController
{
    /**
     * @Route("/", name="collection")
     */
    public function index(): Response
    {
        return $this->render('admin/collection/index.html.twig', [
            'controller_name' => 'MaCollectionController',
        ]);
    }
}
