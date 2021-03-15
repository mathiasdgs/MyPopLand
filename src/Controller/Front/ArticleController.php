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
use Knp\Component\Pager\PaginatorInterface;

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
    public function indexfront(Request $request,ArticleRepository $articleRepository,PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Article::class)->findBy([],['created_at' => 'desc']);

        $articles = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            12 // Nombre de résultats par page
        );
        
        return $this->render('front/article/index.html.twig', [
            'articles' => $articles,
        ]);
    

    }        
    /**
     * @Route("/{id}", name="article_showFront", methods={"GET"})
     */   
    public function show(article $article, ArticleRepository $articleRepository): Response
    {           
        $article = $articleRepository->findOneBy(    
        ['id' => $article->getId()],            
        );       
        
        return $this->render('front/article/show.html.twig', [   
            'id' => $article,
        ]);
    }
}