<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Form\DepenseType;
use App\Repository\CaisseRepository;
use App\Repository\DepenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/depense")
 */
class DepenseController extends AbstractController
{
    /**
     * @Route("/", name="depense_index", methods={"GET"})
     */
    public function index(DepenseRepository $depenseRepository): Response
    {
        return $this->render('depense/index.html.twig', [
            'depenses' => $depenseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="depense_new", methods={"GET","POST"})
     */
    public function new(Request $request,CaisseRepository $caisseRepository): Response
    {
        $depense = new Depense();
        $caiss = $caisseRepository->findAll();
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depense);
            foreach ($caiss as $cais){
                if ($cais->getDate()->format("Y")==date("Y")){
                    $solde = $cais->getSolde();
                    if($depense->getDate()->format("Y")!=date("Y")|| $depense->getMontant()>=$solde|| $depense->getMontant()<=0){
                        $this->addFlash('danger', 'le montant est incorrect  !!!!.');
                        return $this->render('depense/new.html.twig', [
                            'depense' => $depense,
                            'form' => $form->createView(),
                        ]);

                    }else{
                        $cais->setSolde($cais->getSolde()-$depense->getMontant());
                        $entityManager->flush();
                        $this->addFlash('success', 'insertion valider !!!!.');
                        return $this->redirectToRoute('depense_index');

                    }
                }else{
                    $this->addFlash('danger', 'donnée incorrect  !!!!.');
                    return $this->render('depense/new.html.twig', [
                        'depense' => $depense,
                        'form' => $form->createView(),
                    ]);


                }

            }

        }
        return $this->render('depense/new.html.twig', [
            'depense' => $depense,
            'form' => $form->createView(),
        ]);


    }

    /**
     * @Route("/{id}", name="depense_show", methods={"GET"})
     */
    public function show(Depense $depense): Response
    {
        return $this->render('depense/show.html.twig', [
            'depense' => $depense,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="depense_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Depense $depense,CaisseRepository $caisseRepository,DepenseRepository $depenseRepository): Response
    {
        $caiss = $caisseRepository->findAll();
        $mont = $depense->getMontant();
        $form = $this->createForm(DepenseType::class, $depense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('depense_index');
        }


        return $this->render('depense/edit.html.twig', [
            'depense' => $depense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="depense_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Depense $depense): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depense->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($depense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('depense_index');
    }
}
