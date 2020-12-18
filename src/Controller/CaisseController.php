<?php

namespace App\Controller;

use App\Entity\Caisse;
use App\Form\CaisseType;
use App\Repository\CaisseRepository;
use App\Repository\DepenseRepository;
use App\Repository\DiayanteRepository;
use App\Repository\HadiyaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/caisse")
 */
class CaisseController extends AbstractController
{
    /**
     * @Route("/", name="caisse_index", methods={"GET"})
     */
    public function index(CaisseRepository $caisseRepository): Response
    {
        return $this->render('caisse/index.html.twig', [
            'caisses' => $caisseRepository->findAll(),
        ]);
    }
    /**
     * @Route("/solde", name="caisse_solde", methods={"GET"})
     */
    public function solde(HadiyaRepository $hadiyaRepository,Request $request,DiayanteRepository $diayanteRepository,CaisseRepository $caisseRepository,DepenseRepository $depenseRepository): Response
    {

        $sumh =0;
        $sumd =0;
        $susolde =0;
        $sodde =0;
        $hadiya = $hadiyaRepository->findAll();
        $ciasse = $caisseRepository->findAll();
        $diaynte = $diayanteRepository->findAll();
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
        foreach ($depense as $dpp) {
            if ($dpp->getDate()->format("Y") == date("Y")) {
                $sodde+= $dpp->getMontant();
            }
        }
        $total = $sumd+$sumh;
        return $this->render('caisse/show.html.twig', [
            'sumh'=>$sumh,
            'sumd'=>$sumd,
            'susolde'=>$susolde,
            'sodde'=>$sodde,
            'total'=>$total

        ]);

    }

    /**
     * @Route("/new", name="caisse_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $caisse = new Caisse();
        $form = $this->createForm(CaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($caisse);
            $entityManager->flush();

            return $this->redirectToRoute('caisse_index');
        }

        return $this->render('caisse/new.html.twig', [
            'caisse' => $caisse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caisse_show", methods={"GET"})
     */
    public function show(Caisse $caisse): Response
    {
        return $this->render('caisse/show.html.twig', [
            'caisse' => $caisse,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caisse_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Caisse $caisse): Response
    {
        $form = $this->createForm(CaisseType::class, $caisse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caisse_index');
        }

        return $this->render('caisse/edit.html.twig', [
            'caisse' => $caisse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caisse_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Caisse $caisse): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caisse->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caisse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caisse_index');
    }

}
