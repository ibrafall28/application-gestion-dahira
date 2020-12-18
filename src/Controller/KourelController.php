<?php

namespace App\Controller;

use App\Entity\Kourel;
use App\Form\KourelType;
use App\Repository\KourelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kourel")
 */
class KourelController extends AbstractController
{
    /**
     * @Route("/", name="kourel_index", methods={"GET"})
     */
    public function index(KourelRepository $kourelRepository): Response
    {
        return $this->render('kourel/index.html.twig', [
            'kourels' => $kourelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kourel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kourel = new Kourel();
        $form = $this->createForm(KourelType::class, $kourel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kourel);
            $entityManager->flush();
            $this->addFlash('success', 'insertion valider !!!!.');
            return $this->redirectToRoute('kourel_index');
        }

        return $this->render('kourel/new.html.twig', [
            'kourel' => $kourel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kourel_show", methods={"GET"})
     */
    public function show(Kourel $kourel): Response
    {
        return $this->render('kourel/show.html.twig', [
            'kourel' => $kourel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kourel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kourel $kourel): Response
    {
        $form = $this->createForm(KourelType::class, $kourel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kourel_index');
        }

        return $this->render('kourel/edit.html.twig', [
            'kourel' => $kourel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="kourel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Kourel $kourel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kourel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kourel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kourel_index');
    }
}
