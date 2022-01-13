<?php

namespace App\Controller;

use App\Entity\Cadeaux;
use App\Form\CadeauxType;
use App\Repository\CadeauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/gateaux")
 */
class AdminGateauxController extends AbstractController
{
    /**
     * @Route("/", name="admin_gateaux_index", methods={"GET"})
     */
    public function index(CadeauxRepository $cadeauxRepository): Response
    {
        return $this->render('admin_gateaux/index.html.twig', [
            'cadeauxes' => $cadeauxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_gateaux_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cadeaux = new Cadeaux();
        $form = $this->createForm(CadeauxType::class, $cadeaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cadeaux);
            $entityManager->flush();

            return $this->redirectToRoute('admin_gateaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_gateaux/new.html.twig', [
            'cadeaux' => $cadeaux,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_gateaux_show", methods={"GET"})
     */
    public function show(Cadeaux $cadeaux): Response
    {
        return $this->render('admin_gateaux/show.html.twig', [
            'cadeaux' => $cadeaux,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_gateaux_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cadeaux $cadeaux, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CadeauxType::class, $cadeaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_gateaux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_gateaux/edit.html.twig', [
            'cadeaux' => $cadeaux,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_gateaux_delete", methods={"POST"})
     */
    public function delete(Request $request, Cadeaux $cadeaux, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cadeaux->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cadeaux);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_gateaux_index', [], Response::HTTP_SEE_OTHER);
    }
}
