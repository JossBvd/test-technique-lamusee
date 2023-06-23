<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\TelechargementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TelechargementController extends AbstractController
{
    #[Route('/telechargement', name: 'app_telechargement')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $image = new Image;
        $form = $this->createForm(TelechargementType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $texte = $form->get('texte')->getData();
            $url = $form->get('url')->getData();
            $image->setTexte($texte)->setUrl($url);
            $em->persist($image);
            $em->flush();
            // vider le formulaire apres validation
            $form = $this->createForm(TelechargementType::class);
        }

        return $this->render('telechargement/index.html.twig', [
            'controller_name' => 'TelechargementController',
            'form' => $form
        ]);
    }
}
