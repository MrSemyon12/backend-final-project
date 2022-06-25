<?php

namespace App\Controller;

use App\Entity\Favourite;
use App\Form\ToFavouriteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FavouriteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/filmoteka/favourite")
 */
class FavouritesController extends AbstractController
{
    /**
     * @Route("/", name="app_favourite_index", methods={"GET"})
     */
    public function index(FavouriteRepository $favouriteRepository): Response
    {
        return $this->render('favourites/index.html.twig', [
            'favourites' => $favouriteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="app_favourite_add", methods={"GET", "POST"})
     */
    public function add(Request $request, FavouriteRepository $favouriteRepository): Response
    {
        $favourite = new Favourite();
        $form = $this->createForm(ToFavouriteType::class, $favourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favouriteRepository->add($favourite, true);

            return $this->redirectToRoute('app_favourite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favourites/add.html.twig', [
            'favourite' => $favourite,
            'form' => $form,
        ]);
    }
}
