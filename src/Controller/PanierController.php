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
            "total" => $total,
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


    #[Route('/remove/{id}', name:'remove')]
    public function remove(Produit $produit, $id, SessionInterface $session)
    {
       
       // recuperer le panier
       $panier = $session->get("panier", []);
       $id = $produit->getId(); 

           if(!empty($panier[$id])) {
            if($panier[$id] >1){
                $panier[$id]--;
                }
            else {
                unset($panier[$id]);
            }   

        
        //    dd($session);
           //sauvegarder
           $session->set("panier", $panier);
           return $this->redirectToRoute("panier_index");
        }   
    }


    #[Route('/delete/{id}', name:'delete')]
    public function delete(Produit $produit, $id, SessionInterface $session)
    {
       
       // recuperer le panier
       $panier = $session->get("panier", []);
       $id = $produit->getId(); 

           if(!empty($panier[$id])) {
                unset($panier[$id]);
            }   

           //sauvegarder
           $session->set("panier", $panier);
           return $this->redirectToRoute("panier_index");
        }   
    

}
