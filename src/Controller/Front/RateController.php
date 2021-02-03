<?php

namespace App\Controller\Front;
use App\Entity\Article;
use App\Entity\Rate;
use App\Form\RateType;
use App\Repository\RateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RateController extends AbstractController
{
    /**
     * @Route("/front/rate/{id}",name="index", methods={"GET","POST"})
     */
    public function index(Request $request, Article $article, RateRepository $rateRepository): Response
    {   
        $rate =  new Rate();
        $rate->setArticle($article)
        ->setNote($request->get('note'))
        ->setUser($this->getUser());

        $articleId = $rate->getArticle()->getId();
        $allRates = $rateRepository->findBy(['article' => $articleId]);
        $allRates[] = $rate;
        $sum = 0;
        foreach($allRates as $r){
            $sum += $r->getNote();           
        }
        
        $result = round($sum / count($allRates),2) ;
        $rate->getArticle()->setRateAverage($result);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($rate);
        $entityManager->flush();

        return new JsonResponse($result);
        
    } 


}
