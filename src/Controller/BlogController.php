<?php

namespace App\Controller;

use App\Entity\Cryptomonaie;
use App\Repository\CommentairesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
     /**
     * @Route("/crypto", name="crypto.list")
     */
    public function getCrypto(Request $request,PaginatorInterface $paginator):Response
    {
        $donnes= $this->getDoctrine()->getRepository(Cryptomonaie::class)->findAll();
        $crypto =$paginator->paginate(
            $donnes,
            $request->query->getInt('page',1),//numero page en cours
            5
        );
        return $this->render('blog/crypto.html.twig',
        ['controller_name'=>'BlogController',
         'crypto'=>$crypto
        ] 
     );
    }
        /**
         * Lister uniquement les commentaires de l utilisateur !
         * @Route("/commentaires", name="commentaire.list")
         * @return Response
         */
        public function listCommentaires(CommentairesRepository $em) : Response
        { 

        $commentaires =$em->getSesCommentaires($this->getUser());

        return $this->render('commentaires/list.html.twig', [
        'commentaires' => $commentaires,
        ]);
        
        }


}