<?php

namespace App\Controller;

use App\Entity\Khassida;
use App\Form\KhassidaType;
use App\Repository\KhassidaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/khassida")
 */
class KhassidaController extends AbstractController
{
    /**
     * @Route("/", name="khassida_index", methods={"GET"})
     */
    public function index(KhassidaRepository $khassidaRepository): Response
    {
        return $this->render('khassida/index.html.twig', [
            'khassidas' => $khassidaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="khassida_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $khassida = new Khassida();
        $form = $this->createForm(KhassidaType::class, $khassida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($khassida);
            $entityManager->flush();
            $this->addFlash('success', 'insertion valider !!!!.');
            return $this->redirectToRoute('khassida_index');
        }

        return $this->render('khassida/new.html.twig', [
            'khassida' => $khassida,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="khassida_show", methods={"GET"})
     */
    public function show(Khassida $khassida): Response
    {
        return $this->render('khassida/show.html.twig', [
            'khassida' => $khassida,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="khassida_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Khassida $khassida): Response
    {
        $form = $this->createForm(KhassidaType::class, $khassida);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('khassida_index');
        }

        return $this->render('khassida/edit.html.twig', [
            'khassida' => $khassida,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="khassida_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Khassida $khassida): Response
    {
        if ($this->isCsrfTokenValid('delete'.$khassida->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($khassida);
            $entityManager->flush();
        }

        return $this->redirectToRoute('khassida_index');
    }
}
