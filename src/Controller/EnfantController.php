<?php

namespace App\Controller;

use App\Entity\Enfant;
use App\Form\EnfantType;
use App\Repository\EnfantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parent", name="parent_", methods={"GET"})
 */
class EnfantController extends AbstractController
{
    /**
     * @Route("/", name="app_enfant_index", methods={"GET"})
     */
    public function index(EnfantRepository $enfantRepository): Response
    {
        return $this->render('enfant/index.html.twig', [
            'enfants' => $enfantRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_enfant_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EnfantRepository $enfantRepository): Response
    {
        $enfant = new Enfant();
        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enfantRepository->add($enfant);
            return $this->redirectToRoute('parent_app_enfant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enfant/new.html.twig', [
            'enfant' => $enfant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_enfant_show", methods={"GET"})
     */
    public function show(Enfant $enfant): Response
    {
        return $this->render('enfant/show.html.twig', [
            'enfant' => $enfant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_enfant_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Enfant $enfant, EnfantRepository $enfantRepository): Response
    {
        $form = $this->createForm(EnfantType::class, $enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enfantRepository->add($enfant);
            return $this->redirectToRoute('parent_app_enfant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enfant/edit.html.twig', [
            'enfant' => $enfant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_enfant_delete", methods={"POST"})
     */
    public function delete(Request $request, Enfant $enfant, EnfantRepository $enfantRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enfant->getId(), $request->request->get('_token'))) {
            $enfantRepository->remove($enfant);
        }

        return $this->redirectToRoute('parent_app_enfant_index', [], Response::HTTP_SEE_OTHER);
    }
}
