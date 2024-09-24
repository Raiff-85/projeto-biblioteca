<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivroController extends AbstractController
{

    /**
     * @Route("/livro")
     */
    public function index(): Response
    {
        return $this->render('livro/index.html.twig');
    }
}
