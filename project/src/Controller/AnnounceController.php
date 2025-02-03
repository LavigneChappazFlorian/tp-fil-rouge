<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Repository\AnnounceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AnnounceController extends AbstractController
{
    #[Route('/announces', name: 'app_announce')]
    public function index(AnnounceRepository $announceRepository): Response
    {
        $announces = $announceRepository->findAll();
        return $this->render('announce/index.html.twig', [
            'controller_name' => 'AnnounceController',
            'announces' => $announces,
        ]);
    }
}
