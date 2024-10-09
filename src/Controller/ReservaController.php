<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservaController extends AbstractController
{
    #[Route('/area_cliente/reserva', name: 'reserva_index')]
    public function index(): Response
    {
        return $this->render('reserva/reserva.html.twig', [
            'controller_name' => 'ReservaController',
        ]);
    }
}
