<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/change-locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request)
    { 
         //on stocke la langue demandé dans la session 
         $request->getSession()->set('_locale', $locale);
         //on revient sur la page precedente 

         return $this->redirect($request->headers->get('referer'));
    }
}
