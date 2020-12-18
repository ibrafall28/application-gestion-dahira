<?php

namespace App\Controller;

use App\Entity\Dadj;
use App\Form\DadjType;
use App\Repository\DadjRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dadj")
 */
class DadjController extends AbstractController
{
    /**
     * @Route("/", name="dadj_index", methods={"GET"})
     */
    public function index(DadjRepository $dadjRepository): Response
    {
        return $this->render('dadj/index.html.twig', [
            'dadjs' => $dadjRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dadj_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dadj = new Dadj();
        $form = $this->createForm(DadjType::class, $dadj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dadj);
            $entityManager->flush();

            return $this->redirectToRoute('dadj_index');
        }

        return $this->render('dadj/new.html.twig', [
            'dadj' => $dadj,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dadj_show", methods={"GET"})
     */
    public function show(Dadj $dadj): Response
    {
        return $this->render('dadj/show.html.twig', [
            'dadj' => $dadj,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dadj_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dadj $dadj): Response
    {
        $form = $this->createForm(DadjType::class, $dadj);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dadj_index');
        }

        return $this->render('dadj/edit.html.twig', [
            'dadj' => $dadj,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dadj_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dadj $dadj): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dadj->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dadj);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dadj_index');
    }
}
