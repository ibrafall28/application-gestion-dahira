<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Entity\SearchMembre;
use App\Form\MembreType;
use App\Form\SearchMembreType;
use App\Repository\MembreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/membre")
 */
class MembreController extends AbstractController
{
    /**
     * @Route("/", name="membre_index", methods={"GET"})
     */
    public function index(MembreRepository $membreRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $search = new  SearchMembre();
        $form = $this->createForm(SearchMembreType::class,$search);
        $form->handleRequest($request);

        $membre = $paginator->paginate($membreRepository->findBymmbre($search)
            ,$request->query->getInt('page',1)
            ,3);
        return $this->render('membre/index.html.twig', [
            'membres' => $membre,
            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route("/liste", name="membre_liste", methods={"GET"})
     */
    public function liste(MembreRepository $membreRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $search = new  SearchMembre();
        $form = $this->createForm(SearchMembreType::class,$search);
        $form->handleRequest($request);

        $membre = $paginator->paginate($membreRepository->findBymmbre($search)
            ,$request->query->getInt('page',1)
            ,3);
        return $this->render('hadiya/liste.html.twig', [
            'membres' => $membre,
            'form'=>$form->createView(),
        ]);

    }

    /**
     * @Route("/membre", name="membre_imprimer", methods={"GET"})
     */
    public function membre(MembreRepository $membreRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $search = new  SearchMembre();
        $form = $this->createForm(SearchMembreType::class,$search);
        $form->handleRequest($request);

        return $this->render('membre/memebre.html.twig', [
            'membres' => $membreRepository->findBymmbre(),
            'form'=>$form->createView(),
        ]);
    }


    /**
     * @Route("/new", name="membre_new", methods={"GET","POST"})
     */
    public function new(Request $request,MembreRepository $membreRepository): Response
    {
        $id=0;
        $mat = "dsht";
        $membre = new Membre();
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($membre);
            $membre->setEtat(0);
            $membre1 =  $membreRepository->lasteId();
            $membre2 =  $membreRepository->search($membre->getTelephone());
            if($membre1 == null){
                $id +=1;
                $mat1=$mat.$id;
                $membre->setMatricule($mat1);
            }else{
                $id = $membre1->getId()+ 1;
                $mat1=$mat.$id;
                $membre->setMatricule($mat1);
            }

            if($membre2 == null){

                $entityManager->flush();
                $this->addFlash('success', 'insertion valider !!!!.');
                return $this->redirectToRoute('membre_index');

            }
            else{
                //echo $agance1->getId();
                $this->addFlash('danger', 'membre '." ".$membre2->getPrenom()." ".'est deja existe !!!!.');
                return $this->redirectToRoute('membre_new');

            }


        }

        return $this->render('membre/new.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="membre_show", methods={"GET"})
     */
    public function show(Membre $membre): Response
    {
        $membre->setEtat(1);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('membre_index');
    }

    /**
     * @Route("/{id}/edit", name="membre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Membre $membre): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('membre_index');
        }

        return $this->render('membre/edit.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="membre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Membre $membre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('membre_index');
    }
}
