<?php

namespace App\Controller\Front;
use App\Entity\Rate;
use App\Form\RateType;
use App\Repository\RateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    /**
     * @Route("/front/rate")
     */
    public function index(): Response
    {
        return $this->render('front/rate/index.html.twig', [
            'controller_name' => 'RateController',
        ]);
    }
}
