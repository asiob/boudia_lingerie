<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    #[Route('/categorie/new', name: 'new_categorie')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        //permet de rajouter des nouvelles catégories
        $categorie = new Categorie();
        $succes = 'Crée avec succes !';

        $form = $this->createForm( CategorieType::class, $categorie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $categorie = $form->getData();

            $manager->persist($categorie);
            $manager->flush();

            return $this->redirectToRoute('new_categorie');
        }


        return $this->renderForm('categorie/new.html.twig',[
            'form' => $form,

        ]);
    }
}
