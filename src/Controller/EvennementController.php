<?php

namespace App\Controller;

use App\Entity\Evennement;
use App\Form\EvennementType;
use App\Repository\CaisseRepository;
use App\Repository\DepenseRepository;
use App\Repository\DiayanteRepository;
use App\Repository\EvennementRepository;
use App\Repository\HadiyaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evennement")
 */
class EvennementController extends AbstractController
{
    /**
     * @Route("/", name="evennement_index", methods={"GET"})
     */
    public function index(EvennementRepository $evennementRepository): Response
    {
        return $this->render('evennement/index.html.twig', [
            'evennements' => $evennementRepository->findAll(),
        ]);
    }
    /**
     * @Route("/bilani", name="bilan_index", methods={"GET"})
     */
    public function liste(CaisseRepository $caisseRepository, HadiyaRepository $hadiyaRepository,DepenseRepository $depenseRepository,DiayanteRepository $diayanteRepository): Response

    {
        $sumh =0;
        $sumd =0;
        $susolde =0;
        $sumdp=0;
        $hadiya = $hadiyaRepository->findAll();
        $ciasse = $caisseRepository->findAll();
         $diaynte = $diayanteRepository->findAll();
          $depense = $depenseRepository->findAll();
        foreach ($hadiya as $h) {
            if ($h->getDate()->format("Y") == date("Y")) {
                $sumh+= $h->getMontant();
            }
        }
        foreach ($ciasse as $c) {
            if ($c->getDate()->format("Y") == date("Y")) {
                $susolde+= $c->getSolde();
            }
        }
        foreach ($diaynte as $d) {
            if ($d->getDate()->format("Y") == date("Y")) {
                $sumd+= $d->getMontant();
            }
        }
        foreach ($depense as $dp) {
            if ($dp->getDate()->format("Y") == date("Y")) {
                $sumdp+= $dp->getMontant();
            }
        }
        $total = $sumd+$sumh;
        return $this->render('evennement/show.html.twig', [
            'sumh'=>$sumh,
            'sumd'=>$sumd,
            'susolde'=>$susolde,
            'sumdp'=>$sumdp,
            'total'=>$total


        ]);

    }
    /**
     * @Route("/new", name="evennement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $evennement = new Evennement();
        $form = $this->createForm(EvennementType::class, $evennement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($evennement);
            $entityManager->flush();
            $this->addFlash('success', 'insertion valider !!!!.');
            return $this->redirectToRoute('evennement_index');
        }

        return $this->render('evennement/new.html.twig', [
            'evennement' => $evennement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evennement_show", methods={"GET"})
     */
    public function show(Evennement $evennement): Response
    {
        return $this->render('evennement/show.html.twig', [
            'evennement' => $evennement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="evennement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evennement $evennement): Response
    {
        $form = $this->createForm(EvennementType::class, $evennement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evennement_index');
        }

        return $this->render('evennement/edit.html.twig', [
            'evennement' => $evennement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="evennement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Evennement $evennement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evennement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evennement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evennement_index');
    }
}
