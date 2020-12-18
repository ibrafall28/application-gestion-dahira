<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/materiel")
 */
class MaterielController extends AbstractController
{
    /**
     * @Route("/", name="materiel_index", methods={"GET"})
     */
    public function index(MaterielRepository $materielRepository): Response
    {
        return $this->render('materiel/index.html.twig', [
            'materiels' => $materielRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="materiel_new", methods={"GET","POST"})
     */
    public function new(Request $request, MaterielRepository $materielRepository): Response
    {
        $id = 0;
        $materil1 = new Materiel();
        $materiel = new Materiel();
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materiel);
            $materil1 =  $materielRepository->lasteId();
            $mat1 =  $materiel->getLibelle();
            if($materil1 == null){
                $id +=1;
                $mat2=$mat1.$id;
                $materiel->setNumero($mat2);
            }else{
                $id = $materil1->getId()+ 1;
                $mat2=$mat1.$id;
                $materiel->setNumero($mat2);
            }
            $entityManager->flush();
            $this->addFlash('success', 'insertion valider !!!!.');
            return $this->redirectToRoute('materiel_index');
        }

        return $this->render('materiel/new.html.twig', [
            'materiel' => $materiel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="materiel_show", methods={"GET"})
     */
    public function show(Materiel $materiel): Response
    {
        return $this->render('materiel/show.html.twig', [
            'materiel' => $materiel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="materiel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Materiel $materiel): Response
    {
        $form = $this->createForm(MaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materiel_index');
        }

        return $this->render('materiel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="materiel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Materiel $materiel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materiel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($materiel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('materiel_index');
    }
}
