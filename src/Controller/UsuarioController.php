<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'app_usuario')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $nome = "Raiff Nóbrega";
        return $this->render('usuario/index.html.twig', [
            'controller_name' => $nome,
        ]);
    }
}
