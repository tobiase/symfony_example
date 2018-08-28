<?php

namespace App\Controller;

use App\Entity\Stoff;
use App\Form\StoffType;
use App\Repository\StoffRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/stoff")
 */
class StoffController extends Controller
{
    /**
     * @Route("/", name="stoff_index", methods="GET")
     */
    public function index(StoffRepository $stoffRepository): Response
    {
        return $this->render('stoff/index.html.twig', ['stoffs' => $stoffRepository->findAll()]);
    }

    /**
     * @Route("/new", name="stoff_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $stoff = new Stoff();
        $form = $this->createForm(StoffType::class, $stoff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stoff);
            $em->flush();

            return $this->redirectToRoute('stoff_index');
        }

        return $this->render('stoff/new.html.twig', [
            'stoff' => $stoff,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stoff_show", methods="GET")
     */
    public function show(Stoff $stoff): Response
    {
        return $this->render('stoff/show.html.twig', ['stoff' => $stoff]);
    }

    /**
     * @Route("/{id}/edit", name="stoff_edit", methods="GET|POST")
     */
    public function edit(Request $request, Stoff $stoff): Response
    {
        $form = $this->createForm(StoffType::class, $stoff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stoff_edit', ['id' => $stoff->getId()]);
        }

        return $this->render('stoff/edit.html.twig', [
            'stoff' => $stoff,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stoff_delete", methods="DELETE")
     */
    public function delete(Request $request, Stoff $stoff): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stoff->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stoff);
            $em->flush();
        }

        return $this->redirectToRoute('stoff_index');
    }
}
