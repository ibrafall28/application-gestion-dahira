<?php

namespace App\Controller;

use App\Entity\TypeRepetition;
use App\Form\TypeRepetitionType;
use App\Repository\TypeRepetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/repetition")
 */
class TypeRepetitionController extends AbstractController
{
    /**
     * @Route("/", name="type_repetition_index", methods={"GET"})
     */
    public function index(TypeRepetitionRepository $typeRepetitionRepository): Response
    {
        return $this->render('type_repetition/index.html.twig', [
            'type_repetitions' => $typeRepetitionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_repetition_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeRepetition = new TypeRepetition();
        $form = $this->createForm(TypeRepetitionType::class, $typeRepetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeRepetition);
            $entityManager->flush();

            return $this->redirectToRoute('type_repetition_index');
        }

        return $this->render('type_repetition/new.html.twig', [
            'type_repetition' => $typeRepetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_repetition_show", methods={"GET"})
     */
    public function show(TypeRepetition $typeRepetition): Response
    {
        return $this->render('type_repetition/show.html.twig', [
            'type_repetition' => $typeRepetition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_repetition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeRepetition $typeRepetition): Response
    {
        $form = $this->createForm(TypeRepetitionType::class, $typeRepetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_repetition_index');
        }

        return $this->render('type_repetition/edit.html.twig', [
            'type_repetition' => $typeRepetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_repetition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeRepetition $typeRepetition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeRepetition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeRepetition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_repetition_index');
    }
}
