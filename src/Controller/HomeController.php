<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(ImageRepository $repoImage): Response
    {   
        $images = $repoImage->findBy([], null, 5);
        
        return $this->render('home/index.html.twig', [
            'images' => $images
        ]);
    }
}
