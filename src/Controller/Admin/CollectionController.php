<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\User;
use App\Entity\Collection;
use App\Repository\CollectionRepository;
use App\Repository\ArticleRepository;

    /**
     * @Route("/admin/collection")
     */
class CollectionController extends AbstractController
{
    
    /**
     * @Route("/make/{id}", name="makecollection")
     */
    public function makeCollection(Article $article, collectionRepository $collectionRepository ): Response
    {   
        $collection = $this->getUser()->getCollection();
        if ($collection === null){
            $collection = new Collection();
            $collection->setUser($this->getUser());
        }
        $collection->addArticle($article);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($collection);
        $entityManager->flush();         
        return $this->redirectToRoute('show_collection');
    }

    /**
     * @Route("/", name="show_collection" , methods={"GET"} )
     */

    public function show():Response
    {
        return $this->render('/admin/collection/show.html.twig', [
            'collection' => $this->getUser()->getCollection(),
        ]);

    }


     /**
     * @Route("/{id}", name="delete_collection_article", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {   
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->getUser()->getCollection()->removeArticle($article);
            $entityManager->flush();           
        }
    return $this->redirectToRoute('show_collection');
    } 
}
