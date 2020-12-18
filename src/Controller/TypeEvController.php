<?php

namespace App\Controller;

use App\Entity\TypeEv;
use App\Form\TypeEvType;
use App\Repository\TypeEvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/ev")
 */
class TypeEvController extends AbstractController
{
    /**
     * @Route("/", name="type_ev_index", methods={"GET"})
     */
    public function index(TypeEvRepository $typeEvRepository): Response
    {
        return $this->render('type_ev/index.html.twig', [
            'type_evs' => $typeEvRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_ev_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeEv = new TypeEv();
        $form = $this->createForm(TypeEvType::class, $typeEv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeEv);
            $entityManager->flush();

            return $this->redirectToRoute('type_ev_index');
        }

        return $this->render('type_ev/new.html.twig', [
            'type_ev' => $typeEv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_ev_show", methods={"GET"})
     */
    public function show(TypeEv $typeEv): Response
    {
        return $this->render('type_ev/show.html.twig', [
            'type_ev' => $typeEv,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_ev_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeEv $typeEv): Response
    {
        $form = $this->createForm(TypeEvType::class, $typeEv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_ev_index');
        }

        return $this->render('type_ev/edit.html.twig', [
            'type_ev' => $typeEv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_ev_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeEv $typeEv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeEv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeEv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_ev_index');
    }
}
