<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StockController extends AbstractController
{
    #[Route('/stock', name: 'app_stock')]
    public function index(): Response
    {
        return $this->render('stock/index.html.twig', [
            'controller_name' => 'StockController',
        ]);
    }

    #[Route('/stock/new', name: 'new_stock')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $stock = new Stock();
        $form = $this->createForm( StockType::class, $stock);

        return $this->renderForm('stock/new.html.twig',[
            'form' => $form,

        ]);
    }

}
