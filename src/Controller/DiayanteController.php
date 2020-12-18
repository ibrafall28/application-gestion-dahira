<?php

namespace App\Controller;

use App\Entity\Diayante;
use App\Entity\Membre;
use App\Form\DiayanteType;
use App\Repository\DiayanteRepository;
use App\Repository\MembreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/diayante")
 */
class DiayanteController extends AbstractController
{
    /**
     * @Route("/", name="diayante_index", methods={"GET"})
     */
    public function index(DiayanteRepository $diayanteRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $diayante = $paginator->paginate($diayanteRepository->findAll()
            ,$request->query->getInt('page',1)

            ,4);

        return $this->render('diayante/index.html.twig', [
            'diayantes' => $diayante,
        ]);
    }

    /**
     * @Route("/{id}/new", name="diayante_new", methods={"GET","POST"})
     */
    public function new(Request $request,Membre $membre,DiayanteRepository $diayanteRepository): Response
    {
        $mnt=0 ;
        $diayante = new Diayante();
        $form = $this->createForm(DiayanteType::class, $diayante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($diayante);
            $diayante->setMembre($membre);
            $diayante->setMembre($membre);
            if ($diayante->getMontant()<=0 || $diayante->getDate()->format("Y")!=date("Y") ){
                $this->addFlash('danger', 'le montant doit etre superieur a 0  ou la date est incorrect !!!!.');
                return $this->render('diayante/new.html.twig', [
                    'diayante' => $diayante,
                    'form' => $form->createView(),
                ]);

            }else {

                   $diayante->getCaisse()->setSolde($diayante->getMontant() + $diayante->getCaisse()->getSolde());

                $entityManager->flush();
                $this->addFlash('success', 'insertion valdée !!!!.');


            }

            return $this->redirectToRoute('diayante_index');
        }

        return $this->render('diayante/new.html.twig', [
            'diayante' => $diayante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/liste", name="diayante_show", methods={"GET"})
     */
    public function show(DiayanteRepository $diayanteRepository): Response
    {
        $diayante =$diayanteRepository->findAll();
        $t =array();
        $som = 0;
        foreach ($diayante as $m){
            if($m->getDate()->format("Y")==date("Y")){
                $t[]=$m;
                $som+= $m->getMontant();

            }

        }

        return $this->render('diayante/show.html.twig', [
            't' => $t,
            'som'=>$som
        ]);
    }

    /**
     * @Route("/{id}/edit", name="diayante_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Diayante $diayante,DiayanteRepository $diayanteRepository): Response
    {
        $mont = $diayante->getMontant();
        $form = $this->createForm(DiayanteType::class, $diayante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($diayante->getMontant() <= 0|| $diayante->getDate()->format("Y")==date("Y")) {
                $this->addFlash('danger', 'le  ' . " " . $diayante->getMontant() . " " . 'est superieur du totlal année ou egal a 0   !!!!.');

            } else {
                $h = $diayanteRepository->findById($diayante->getId());
                $somr = $diayante->getMontant();

                $diayante->getCaisse()->setSolde($diayante->getCaisse()->getSolde() -$mont+$somr);
                $this->getDoctrine()->getManager()->flush();

            }

            return $this->redirectToRoute('diayante_index');
        }

        return $this->render('diayante/edit.html.twig', [
            'diayante' => $diayante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="diayante_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Diayante $diayante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$diayante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($diayante);
            $mnt = $diayante->getMontant();
            $diayante->getCaisse()->setSolde($diayante->getCaisse()->getSolde()-$mnt);

            $entityManager->flush();
        }

        return $this->redirectToRoute('diayante_index');
    }
}
