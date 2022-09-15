<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAll();

        return $this->render('produit/index.html.twig', [
            'lesProduits' => $produits,

        ]);
    }
    
    #[Route('/produit/new', name: 'new_produit')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $produit = new Produit();
        $form = $this->createForm( ProduitType::class, $produit);

        return $this->renderForm('produit/new.html.twig',[
            'form' => $form,

        ]);
    }
    
}
