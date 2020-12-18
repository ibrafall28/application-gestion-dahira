<?php

namespace App\Controller;

use App\Entity\TypeMateriel;
use App\Form\TypeMaterielType;
use App\Repository\TypeMaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/materiel")
 */
class TypeMaterielController extends AbstractController
{
    /**
     * @Route("/", name="type_materiel_index", methods={"GET"})
     */
    public function index(TypeMaterielRepository $typeMaterielRepository): Response
    {
        return $this->render('type_materiel/index.html.twig', [
            'type_materiels' => $typeMaterielRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_materiel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeMateriel = new TypeMateriel();
        $form = $this->createForm(TypeMaterielType::class, $typeMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeMateriel);
            $entityManager->flush();

            return $this->redirectToRoute('type_materiel_index');
        }

        return $this->render('type_materiel/new.html.twig', [
            'type_materiel' => $typeMateriel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_materiel_show", methods={"GET"})
     */
    public function show(TypeMateriel $typeMateriel): Response
    {
        return $this->render('type_materiel/show.html.twig', [
            'type_materiel' => $typeMateriel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_materiel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeMateriel $typeMateriel): Response
    {
        $form = $this->createForm(TypeMaterielType::class, $typeMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_materiel_index');
        }

        return $this->render('type_materiel/edit.html.twig', [
            'type_materiel' => $typeMateriel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_materiel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeMateriel $typeMateriel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeMateriel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeMateriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_materiel_index');
    }
}
