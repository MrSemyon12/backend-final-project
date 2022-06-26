<?php

namespace App\Controller;

use App\Entity\Favourite;
use App\Form\FavouriteType;
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
        $form = $this->createForm(FavouriteType::class, $favourite);
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

    /**
     * @Route("/{id}/edit", name="app_favourite_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Favourite $favourite, FavouriteRepository $favouriteRepository): Response
    {
        $form = $this->createForm(FavouriteType::class, $favourite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $favouriteRepository->add($favourite, true);

            return $this->redirectToRoute('app_favourite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('favourites/edit.html.twig', [
            'favourite' => $favourite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_favourite_delete", methods={"POST"})
     */
    public function delete(Request $request, Favourite $favourite, FavouriteRepository $favouriteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$favourite->getId(), $request->request->get('_token'))) {
            $favouriteRepository->remove($favourite, true);
        }

        return $this->redirectToRoute('app_favourite_index', [], Response::HTTP_SEE_OTHER);
    }
}
