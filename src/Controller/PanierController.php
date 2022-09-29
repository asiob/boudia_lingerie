<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/panier', name:'panier_')]

class PanierController extends AbstractController
{
    
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository ): Response
    {

        $panier =$session->get("panier", []);
        
        //je "fabrique" les données
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $produit = $produitRepository->find($id);
            $dataPanier[] = [
                "produit" =>$produit,
                "quantite" => $quantite
            ];
            $total += $produit->getPrix() * $quantite;
           
        }

        return $this->render('panier/index.html.twig', [
            "dataPanier" => $dataPanier,
        ]);
       
    }

    #[Route('/add/{id}', name:'add')]
    public function add(Produit $produit, $id, SessionInterface $session)
    {
       
       // recuperer le panier
       $panier = $session->get("panier", []);
       $id = $produit->getId(); 

           if(!empty($panier[$id])) {
            $panier[$id]++;
           } else {
            $panier[$id] = 1;
           }
        //    dd($session);
           //sauvegarder
           $session->set("panier", $panier);
           return $this->redirectToRoute("panier_index");
          
    }
}
