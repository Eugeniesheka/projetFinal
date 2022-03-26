<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Secteur;
use App\Entity\Cryptomonaie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class AdminController extends AbstractDashboardController
{
    /**
<<<<<<< HEAD
       * @Route("/admin", name="admin")

       */
=======
     * @Route("/admin", name="admin")
     */
>>>>>>> 37d6d9587651de9a237f37ef5c5edf4623096913
    public function index(): Response
    {
        return parent::index();
    }
    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateTimeFormat('medium', 'short');
    }
    
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MetaUnivers');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Secteur', 'fa fa-file-text-o', Secteur::class);
        yield MenuItem::linkToCrud('Cryptomonnaie', 'fa fa-file-text-o', Cryptomonaie::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
