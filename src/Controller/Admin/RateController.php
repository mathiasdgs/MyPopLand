<?php

namespace App\Controller\Admin;

use App\Entity\Rate;
use App\Entity\Article;
use App\Form\RateType;
use App\Repository\RateRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/rate", name="admin_rate_")
 */
class RateController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(RateRepository $rateRepository): Response
    {       
        $article = new Article;

        return $this->render('/admin/rate/index.html.twig', [
            'rates' => $rateRepository->findAll(),   
            ]);           
    }
    /**
     * @Route("/new", name="new", methods={"GET","POST"})
     */
    public function new(Request $request, RateRepository $rateRepository): Response
    {
        $rate = new Rate();
        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleId = $rate->getArticle()->getId();
            $allRates = $rateRepository->findBy(['article' => $articleId]);
            $allRates[] = $rate;
            $sum = 0;
            foreach($allRates as $r){
                $sum += $r->getNote();           
            }
            $result = $sum / count($allRates);
            $rate->getArticle()->setRateAverage($result);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rate);
            $entityManager->flush();

            return $this->redirectToRoute('admin_rate_index');
        }

        return $this->render('/admin/rate/new.html.twig', [
            'rate' => $rate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Rate $rate): Response
    {
        return $this->render('/admin/rate/show.html.twig', [
            'rate' => $rate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rate $rate): Response
    {
        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_rate_index');
        }

        return $this->render('/admin/rate/edit.html.twig', [
            'rate' => $rate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rate $rate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_rate_index');
    }

    
}

