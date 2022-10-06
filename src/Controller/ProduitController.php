<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    public function __toString() {
        return $this->somePropertyOrPlainString;
    }

    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }
// route produits par catégorie
    #[Route('/lingerie_menstruelle', name: 'app_produit_lingerie_menstruelle', methods: ['GET'])]
    public function produitParMenstruelle(ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findOneBy(["nom"=>'Culotte menstruelle']);
        
        return $this->render('produit/lingerie_menstruelle.html.twig', [
            'produits' => $produitRepository->findBy([
                'categorie' => $categorie->getId(),
            ]),
        ]);
    }
    
    #[Route('/culotte', name: 'app_produit_culotte', methods: ['GET'])]
    public function produitParCulotte(ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findOneBy(["nom"=>'Culotte']);
        
        return $this->render('produit/culotte.html.twig', [
            'produits' => $produitRepository->findBy([
                'categorie' => $categorie->getId(),
            ]),
        ]);
    }
    #[Route('/soutiens-gorge', name: 'app_produit_soutiens-gorge', methods: ['GET'])]
    public function produitParSoutiens(ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findOneBy(["nom"=>'Soutiens-gorge']);
        
        return $this->render('produit/soutiens-gorge.html.twig', [
            'produits' => $produitRepository->findBy([
                'categorie' => $categorie->getId(),
                // 'specificite' => $specificite->getId(), wx
            ]),
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository, EntityManagerInterface $manager): Response
    {
        // dump($request);
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            // on recupere les images ajoutées
            $images = $form->get('images')->getData();
            // dd($images);
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
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
            
            // $produitRepository->add($produit, true);
            // envoi dans la bdd
            $manager->persist($produit);
            $manager->flush();
          
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    //suprimer un produit entier

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            // $produitRepository->remove($produit, true);

            $manager->remove($produit);
            $manager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }



//pouvoir supprimer l'image que l'ont souhaite

#[Route('/supprime/image/{id}', name: 'produit_delete_image', methods: ['POST', 'DELETE'])]
public function deleteImage(Image $image, Request $request, EntityManagerInterface $manager ) {
   //securiser
    $data = json_decode($request->getContent(), true);
        // on verifie si le token est valide
    if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token']))
    {
        //on recupere le om de li'mage
        $nom = $image->getNom();
        // on supprime
        unlink($this->getParameter('images_directory').'/'.$nom);

        $manager->remove($image);
        $manager->flush();

        //on repond en json
        return new JsonResponse(['success' => 1]);
    } else {
        return new JsonResponse(['error' => 'Token Invalide'], 400);
    }
}

}



