<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;
<<<<<<< HEAD
use App\Form\PropertySearchType;
use App\Entity\PropertySearch;

=======
>>>>>>> 37d6d9587651de9a237f37ef5c5edf4623096913
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesController extends AbstractController
{
    /**
     * @Route("/annonces", name="annonces.list")
     */
    public function list(Request $request ,PaginatorInterface $paginator): Response
<<<<<<< HEAD
    {    
        //$propertySearch= new PropertySearch();
        //$form=$this->createForm()
=======
    {   
>>>>>>> 37d6d9587651de9a237f37ef5c5edf4623096913
        $donnes= $this->getDoctrine()->getRepository(Annonces::class)->findAll();
        $annonces =$paginator->paginate(
            $donnes,
            $request->query->getInt('page',1),//numero page en cours
            5
        );
        return $this->render('annonces/list.html.twig', [
            'controller_name' => 'AnnoncesController',
            'annonces'=>$annonces,
        ]);
    }
   /**
     * Afficher les plus d' infos sur les annonces
     * @Route("/annonces/{id}", name="annonce.show", requirements={"id" = "\d+"})
    */
    public function show(Annonces $annonce){

        return $this->render('annonces/show.html.twig',[
            'annonce' => $annonce,
        ]);
    }
      /**
     * Permet de créer une nouvelle annonce
     * @Route("/annonces/new", name="annonces.create")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function create(Request $request, EntityManagerInterface $em) : Response
    {
        $annonce= new Annonces();
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD
            $em->persist($annonce);
=======
            $em->persist($article);
>>>>>>> 37d6d9587651de9a237f37ef5c5edf4623096913
            $em->flush();
            return $this->redirectToRoute('annonces.list');
        }
         return $this->render('annonces/create.html.twig', 
         ['form' => $form->createView(), ]);            
    }
       /**
     * Éditer une annonce .
     * @Route("annonces/{id}/edit", name="annonce.edit")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, Annonces $annonce, EntityManagerInterface $em) : Response
    {
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();
        return $this->redirectToRoute('annonces.list');
        }
        return $this->render('annonces/create.html.twig', [
        'form' => $form->createView(),
        ]);
    }

}
