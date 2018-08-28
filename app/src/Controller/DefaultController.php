<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/hello/{name}")
     * @param $name
     * @return Response
     */
    public function index($name): Response
    {
        return $this->render('default/index.html.twig', [
            'name' => $name,
        ]);
    }

    /**
     * @Route("simplicity")
     */
    public function simple()
    {
        return new Response('Simple! Easy! Great!');
    }
}