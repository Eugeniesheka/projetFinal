<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\SearchAnnonceType;
use  App\Repository\AnnoncesRepository;
use App\Annonces;


class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="app_search")
     */
    public function searchAnnonces (Request $request ,AnnoncesRepository $AnnoncesRepository  ) 
    {
         $annonces=[];
        $searchAnnonceForm =$this->createForm(SearchAnnonceType::class);
        
        if($searchAnnonceForm->handleRequest($request)->isSubmitted() && $searchAnnonceForm->isValid())
        {
            
                $criteria = $searchAnnonceForm->getData();
                $annonces = $AnnoncesRepository->searchAnnonces($criteria);
               
                 
        }
        return $this->render('search/index.html.twig', [
            'search_form' => $searchAnnonceForm->createView(),
            'annonces' =>$annonces
         
         ]);
    }


   
}
