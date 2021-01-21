<?php

namespace App\Controller\Admin;
use App\Entity\Rate;
use App\Form\RateType;
use App\Repository\RateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    /**
     * @Route("/admin/rate")
     */
    public function index(): Response
    {
        return $this->render('admin/rate/index.html.twig', [
            'controller_name' => 'RateController',
        ]);
    }
}
