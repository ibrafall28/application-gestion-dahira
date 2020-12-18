<?php

namespace App\Controller;

use App\Entity\Repetition;
use App\Form\RepetitionType;
use App\Repository\RepetitionRepository;
use Container8CObnOq\getConsole_ErrorListenerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/repetition")
 */
class RepetitionController extends AbstractController
{
    /**
     * @Route("/", name="repetition_index", methods={"GET"})
     */
    public function index(RepetitionRepository $repetitionRepository): Response
    {
        return $this->render('repetition/index.html.twig', [
            'repetitions' => $repetitionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="repetition_new", methods={"GET","POST"})
     */
    public function new(Request $request,RepetitionRepository $repetitionRepository): Response
    {
        $repetition = new Repetition();
        $form = $this->createForm(RepetitionType::class, $repetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($repetition);
            $hd =$repetition->getHeurdebut();
            $hf = $repetition->getHeurfin();

            if ($hd >= $hf) {
                $this->addFlash('danger', 'veuillez verifer les heurs  !!!!.');
                return $this->render('repetition/new.html.twig', [
                    'repetition' => $repetition,
                    'form' => $form->createView(),
                ]);

            }else{
                $r =$repetitionRepository->findAll();
                foreach ($r as $re){
                    if ($repetition->getDate()->format("Y-d-m")==
                        $re->getDate()->format("Y-d-m")
                        && $re->getHeurdebut()->format("H:m")==$repetition->getHeurdebut()->format("H:m")
                        && $re->getHeurfin()->format("H:m")
                        ==$repetition->getHeurfin()->format("H:m")&& $re->getLieu()==$repetition->getLieu()){
                        $this->addFlash('danger', 'cette date est non disponible  !!!!.');
                        return $this->render('repetition/new.html.twig', [
                            'repetition' => $repetition,
                            'form' => $form->createView(),
                        ]);

                    }else{
                        $entityManager->flush();
                        $this->addFlash('success', 'insertion validée  !!!!.');
                        return $this->redirectToRoute('repetition_index');

                    }
                }



            }

        }

        return $this->render('repetition/new.html.twig', [
            'repetition' => $repetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="repetition_show", methods={"GET"})
     */
    public function show(Repetition $repetition): Response
    {
        return $this->render('repetition/show.html.twig', [
            'repetition' => $repetition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="repetition_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Repetition $repetition): Response
    {
        $form = $this->createForm(RepetitionType::class, $repetition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('repetition_index');
        }

        return $this->render('repetition/edit.html.twig', [
            'repetition' => $repetition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="repetition_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Repetition $repetition): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repetition->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($repetition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('repetition_index');
    }
}
