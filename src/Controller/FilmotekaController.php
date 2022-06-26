<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmotekaController extends AbstractController
{
    #[Route('/filmoteka', name: 'app_filmoteka')]
    public function index(): Response
    {
        return $this->render('filmoteka/index.html.twig', [
            'controller_name' => 'FilmotekaController',
        ]);
    }
}
