<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;



class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier_index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository ): Response
    {

        return $this->render('cart/index.html.twig', []); 
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

        return $this->render('panier/index.html.twig', compact("dataPanier", "total"));
        //  [
        //     'controller_name' => 'PanierController',
        // ]);
    }


//la route vers le panier


    public function add($id, SessionInterface $session)
    {
       // recuperer le panier
       $panier = $session->get("panier", []);

           if(!empty($panier[$id])) {
            $panier[$id]++;
           } else {
            $panier[$id] = 1;
           }
           //sauvegarder
           $session->set("panier", $panier);
           return $this->redirectToRoute("panier_index");
    }
}
