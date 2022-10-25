<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProduitCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator) {
        
    }
// grace à easy admin
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        $url = $this->adminUrlGenerator
            ->setController(ProduitCrudController::class)
            ->generateUrl();
//generer la route de l'affichage des produits
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }


// pour personnaliser et configurer le tableau de bord
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Boudia Lingerie');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('E-commerce');
        yield MenuItem::section('Produits');
        yield MenuItem::subMenu('Actions','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un produit', 'fas fa-plus', Produit::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les produits', 'fas fa-eye', Produit::class),
        ]) ;


        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
