<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AnnouceController extends AbstractController
{
    #[Route('/annouce', name: 'app_annouce')]
    public function index(): Response
    {
        return $this->render('annouce/index.html.twig', [
            'controller_name' => 'AnnouceController',
        ]);
    }
}
