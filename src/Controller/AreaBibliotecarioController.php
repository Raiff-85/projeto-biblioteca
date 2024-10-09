<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AreaBibliotecarioController extends AbstractController
{
    /**
     * @Route("/menu/area-bibliotecario", name="area_biblio_index")
     */
    public function index(): Response
    {
        return $this->render('area_do_bibliotecario/area_bibliotecario.html.twig', [
            'controller_name' => 'AreaBibliotecarioController',
        ]);
    }
}