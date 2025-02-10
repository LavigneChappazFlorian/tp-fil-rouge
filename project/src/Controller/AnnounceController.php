<?php

namespace App\Controller;

use App\Entity\Announce;
use App\Form\CreateAnnounceType;
use App\Repository\AnnounceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class AnnounceController extends AbstractController
{
    #[Route('/announces', name: 'announce')]
    public function index(AnnounceRepository $announceRepository): Response
    {
        $announces = $announceRepository->findAll();
        return $this->render('announce/index.html.twig', [
            'controller_name' => 'AnnounceController',
            'announces' => $announces,
        ]);
    }

    #[Route('/announces/create', name: 'announce_create')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $announce = new Announce();

        $form = $this->createForm(CreateAnnounceType::class, $announce); // création d'un formulaire avec la récupération du formulaire "type"

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($announce); // prépare/mets en attente les données avant de les insérer ou update dans la bdd
            $em->flush(); // éxécute réellement les requêtes SQL en attente

            return $this->redirectToRoute('announce');
        }

        return $this->render('announce/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/announces/{id}/edit', name: 'announce_edit', requirements: ['id' => '\d+'])]
    public function edit(AnnounceRepository $announceRepository, Request $request, EntityManagerInterface $em, int $id): Response
    {
        $one_announce = $announceRepository->find($id);

        $form = $this->createForm(CreateAnnounceType::class, $one_announce); // création d'un formulaire avec la récupération du formulaire "type"

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($one_announce); // prépare/mets en attente les données avant de les insérer ou update dans la bdd
            $em->flush(); // éxécute réellement les requêtes SQL en attente

            return $this->redirectToRoute('announce');
        }

        return $this->render('announce/edit.html.twig', [
            'one_announce' => $one_announce,
            'form' => $form->createView(),
        ]);
    }
}
