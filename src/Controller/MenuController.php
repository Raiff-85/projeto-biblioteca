<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu_index', methods: ['GET'])]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('menu/menu.html.twig', [
            'controller_name' => 'MenuController',
            'user' => $user
        ]);
    }
}
