<?php

namespace App\Controller;

use App\Entity\Salutation;
use App\Form\SalutationType;
use App\Repository\SalutationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salutation")
 */
class SalutationController extends Controller
{
    /**
     * @Route("/", name="salutation_index", methods="GET")
     */
    public function index(SalutationRepository $salutationRepository): Response
    {
        return $this->render('salutation/index.html.twig', ['salutations' => $salutationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="salutation_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $salutation = new Salutation();
        $form = $this->createForm(SalutationType::class, $salutation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salutation);
            $em->flush();

            return $this->redirectToRoute('salutation_index');
        }

        return $this->render('salutation/new.html.twig', [
            'salutation' => $salutation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salutation_show", methods="GET")
     */
    public function show(Salutation $salutation): Response
    {
        return $this->render('salutation/show.html.twig', ['salutation' => $salutation]);
    }

    /**
     * @Route("/{id}/edit", name="salutation_edit", methods="GET|POST")
     */
    public function edit(Request $request, Salutation $salutation): Response
    {
        $form = $this->createForm(SalutationType::class, $salutation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salutation_edit', ['id' => $salutation->getId()]);
        }

        return $this->render('salutation/edit.html.twig', [
            'salutation' => $salutation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salutation_delete", methods="DELETE")
     */
    public function delete(Request $request, Salutation $salutation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $salutation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salutation);
            $em->flush();
        }

        return $this->redirectToRoute('salutation_index');
    }

}
