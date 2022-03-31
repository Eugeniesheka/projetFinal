<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Form\AnnoncesType;

use App\Form\PropertySearchType;
use App\Entity\PropertySearch;
use Doctrine\ORM\EntityRepository;

use App\Entity\Commentaires;
use App\Form\CommentairesType;
use Doctrine\Persistence\ObjectManager;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnoncesController extends AbstractController
{
    /**
     * 
     * @Route("/annonces", name="annonces.list")
     */
    public function list(Request $request ,PaginatorInterface $paginator): Response
    {    
        //$propertySearch= new PropertySearch();
        //$form=$this->createForm()
    {   
        $donnes= $this->getDoctrine()->getRepository(Annonces::class)->findAll();
        $annonces =$paginator->paginate(
            $donnes,
            $request->query->getInt('page',1),//numero page en cours 5
        );
        return $this->render('annonces/list.html.twig', [
            'controller_name' => 'AnnoncesController',
            'annonces'=>$annonces,
        ]);
    }
}
   /**
     * Afficher les plus d' infos sur les annonces
     * @Route("/annonces/{id}", name="annonce.show", requirements={"id" = "\d+"})
    */
    public function show(Annonces $annonce,Request $request,EntityManagerInterface $em){
        $commentaire= new Commentaires();
       
        //$comment->setAuthor($this->getUser());
        $form =$this->createForm(CommentairesType::class,$commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            
            $commentaire->setAnnonce($annonce)
                        ->setCreatAt(new\DateTime())
                        ->setAuteur($this->getUser());
            $em->persist($commentaire);
           $em->flush();
            return $this->redirectToRoute('annonce.show',['id'=>$annonce->getId()]);

        }
        $form = $this->createForm(CommentairesType::class, $commentaire);
        return $this->render('annonces/show.html.twig',[
            'annonce' => $annonce,
            'commentairesForm' => $form->createView(), 
        ]);
    }
      /**
     * Permet de créer une nouvelle annonce
     * @IsGranted("ROLE_USER")
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
            $em->persist($annonce);
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
