<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{

    /**
     * @Route("/cliente")
     */
    public function index(): Response
    {
        return $this->render('cliente/index.html.twig');
    }
}
