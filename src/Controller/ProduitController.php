<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Form\Produit1Type;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository, EntityManagerInterface $manager): Response
    {
        // dump($request);
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        // dd($form);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            // on recupere les images ajoutées
            $images = $form->get('images')->getData();
            // on boucle sur les images
            foreach($images as $image){
                // on génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
                //on copie le fichier dans le dossier upload
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //on stocke l'image dans la base de donnée (son nom)
                $img = new Image();
                $img->setNom($fichier);
                // $produit->setCouleur($couleur);
                $produit->addImage($img);
            }

            $produitRepository->add($produit, true);
            // envoi dans la bdd
            $manager->persist($produit);
            $manager->flush();


            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitRepository->add($produit, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }

//essai de creation de chemin vers page -> apres ajout d'un produit il sera placé dans une autre page automatiquement


// #[Route('/soutiens-gorge', name: 'app_produit_soutiens-gorge', methods: ['GET'])]
// public function index(ProduitRepository $produitRepository): Response
// {
//     return $this->render('produit/soutiens-gorge.html.twig', [
//         'produits' => $produitRepository->findAll(),
//     ]);
// }


}
