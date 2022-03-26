<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
<<<<<<< HEAD
    * @Route("/", name="home")
=======
     * @Route("/", name="home")
>>>>>>> 37d6d9587651de9a237f37ef5c5edf4623096913
     */
    public function home(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }
}
