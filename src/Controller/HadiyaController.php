<?php

namespace App\Controller;

use App\Entity\Filtre;
use App\Entity\Hadiya;
use App\Entity\Membre;
use App\Entity\SearchMembre;
use App\Form\FiltreHadiyaType;
use App\Form\HadiyaType;
use App\Form\SearchMembreType;
use App\Repository\HadiyaRepository;
use App\Repository\MembreRepository;
use ContainerAhz1OYh\getConsole_ErrorListenerService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hadiya")
 */
class HadiyaController extends AbstractController
{

    /**
     * @Route("/", name="hadiya_index", methods={"GET"})
     */
    public function index(HadiyaRepository $hadiyaRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $hadiya = $paginator->paginate($hadiyaRepository->findAll()
            ,$request->query->getInt('page',1)

            ,4);

        return $this->render('hadiya/index.html.twig', [
            'hadiyas' => $hadiya,
        ]);
    }

    /**
     * @Route("/{id}/new", name="hadiya_new", methods={"GET","POST"})
     */
    public function new(Request $request,Membre $membre,HadiyaRepository $hadiyaRepository): Response
    {
        $mnt=0 ;

        $hadiya = new Hadiya();
        $form = $this->createForm(HadiyaType::class, $hadiya);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hadiya);
            $hadiya->setMembre($membre);
            $date1 = $hadiya->getDate();
            $date2 = date("Y");
            if($hadiya->getDate()->format("Y")==date("Y")) {

                $mnt = $hadiyaRepository->sommeByMembre($membre);
                if ( $hadiya->getMontant() <= 0) {
                    $this->addFlash('danger', 'le  ' . " " . $hadiya->getMontant() . " " . 'est superieur du totlal année ou egal a 0   !!!!.');
                    return $this->render('hadiya/new.html.twig', [
                        'hadiya' => $hadiya,
                        'form' => $form->createView(),
                    ]);

                } else if (($membre->getSexe() == 'M' && $membre->getAge() < 18 && $mnt == 5000)) {
                    $this->addFlash('danger', 'membre ' . " " . $membre->getPrenom() . " " . 'est deja attaidre le montant total de l annee !!!!.');
                    return $this->render('hadiya/new.html.twig', [
                        'hadiya' => $hadiya,
                        'form' => $form->createView(),
                    ]);

                } else if (($membre->getSexe() == 'F' && $membre->getAge() < 18 && $mnt == 5000)) {
                    $this->addFlash('danger', 'membre ' . " " . $membre->getPrenom() . " " . 'est deja attaidre le montant total de l annee !!!!.');
                    $this->addFlash('danger',  'date incorrect !!!!.');
                    return $this->render('hadiya/new.html.twig', [
                        'hadiya' => $hadiya,
                        'form' => $form->createView(),
                    ]);
                } else if (($membre->getSexe() == 'M' && $membre->getAge() >= 18 && $mnt == 10000)) {
                    $this->addFlash('danger', 'membre ' . " " . $membre->getPrenom() . " " . 'est deja attaidre le montant total de l annee !!!!.');
                    $this->addFlash('danger',  'date incorrect !!!!.');
                    return $this->render('hadiya/new.html.twig', [
                        'hadiya' => $hadiya,
                        'form' => $form->createView(),
                    ]);
                } else if (($membre->getSexe() == 'F' && $membre->getAge() >= 18 && $mnt == 10000)) {
                    $this->addFlash('danger', 'membre ' . " " . $membre->getPrenom() . " " . 'est deja attaidre le montant total de l annee !!!!.');
                    $this->addFlash('danger',  'date incorrect !!!!.');
                    return $this->render('hadiya/new.html.twig', [
                        'hadiya' => $hadiya,
                        'form' => $form->createView(),
                    ]);
                } else {
                    $hadiya->getCaisse()->setSolde($hadiya->getMontant() + $hadiya->getCaisse()->getSolde());
                    $entityManager->flush();
                    $this->addFlash('success',  'insertion validée !!!!.');

                    return $this->redirectToRoute('hadiya_index');

                }
            }else{
                $this->addFlash('danger',  'date incorrect !!!!.');
                return $this->render('hadiya/new.html.twig', [
                    'hadiya' => $hadiya,
                    'form' => $form->createView(),
                ]);



            }


            return $this->redirectToRoute('hadiya_index');
        }

        return $this->render('hadiya/new.html.twig', [
            'hadiya' => $hadiya,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hadiya_show", methods={"GET"})
     */
    public function show(Membre $membre): Response
    {
        $t =array();
        $som = 0;
        foreach ($membre->getHadiyas() as $m){
            if($m->getDate()->format("Y")==date("Y")){
                $t[]=$m;
                $som+= $m->getMontant();

            }

    }
        return $this->render('hadiya/show.html.twig', [
            't' => $t,
            'membre'=>$membre,
            'som'=>$som
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hadiya_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hadiya $hadiya,HadiyaRepository $hadiyaRepository): Response
    {
        $mont = $hadiya->getMontant();
        $form = $this->createForm(HadiyaType::class, $hadiya);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


                if ($hadiya->getMontant() <= 0) {
                    $this->addFlash('danger', 'le  ' . " " . $hadiya->getMontant() . " " . 'est superieur du totlal année ou egal a 0   !!!!.');

                } else {
                    $h = $hadiyaRepository->findById($hadiya->getId());
                    $somr = $hadiya->getMontant();

                    $hadiya->getCaisse()->setSolde($hadiya->getCaisse()->getSolde() -$mont+$somr);
                    $this->getDoctrine()->getManager()->flush();

                }


            return $this->redirectToRoute('hadiya_index');
        }

        return $this->render('hadiya/edit.html.twig', [
            'hadiya' => $hadiya,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hadiya_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hadiya $hadiya): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hadiya->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hadiya);
            $mnt = $hadiya->getMontant();
            $hadiya->getCaisse()->setSolde($hadiya->getCaisse()->getSolde()-$mnt);
            $entityManager->flush();

        }

        return $this->redirectToRoute('hadiya_index');
    }
}
