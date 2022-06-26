<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/filmoteka/film")
 */
class FilmController extends AbstractController
{
    /**
     * @Route("/", name="app_film_index", methods={"GET"})
     */
    public function index(FilmRepository $filmRepository): Response
    {
        return $this->render('film/index.html.twig', [
            'films' => $filmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/add", name="app_film_add", methods={"GET", "POST"})
     */
    public function add(Request $request, FilmRepository $filmRepository): Response
    {
        $film = new Film();
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filmRepository->add($film, true);

            return $this->redirectToRoute('app_film_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('film/add.html.twig', [
            'film' => $film,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_film_show", methods={"GET"})
     */
    public function show(Film $film): Response
    {
        return $this->render('film/show.html.twig', [
            'film' => $film,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_film_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Film $film, FilmRepository $filmRepository): Response
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filmRepository->add($film, true);

            return $this->redirectToRoute('app_film_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('film/edit.html.twig', [
            'film' => $film,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_film_delete", methods={"POST"})
     */
    public function delete(Request $request, Film $film, FilmRepository $filmRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $filmRepository->remove($film, true);
        }

        return $this->redirectToRoute('app_film_index', [], Response::HTTP_SEE_OTHER);
    }
}
