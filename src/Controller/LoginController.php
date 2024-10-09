<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/menu/login', name: 'login_index')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $errorMessage = $error?->getMessage();
        $user = $this->getUser();

        if ($user) {
            // Redireciona para o menu após o login
            return $this->redirectToRoute('menu_index');
        }

        return $this->render('login/login.html.twig', [
            'error' => $errorMessage,
            'last_username' => $lastUsername,
            'user' => $user
        ]);
    }

    #[Route('/check-auth', name: 'check_auth')]
    public function checkAuth(): JsonResponse
    {
        $user = $this->getUser(); // Obtém o usuário autenticado

        return $this->json(['authenticated' => $user !== null]);
    }

    #[Route('/logout', name: 'logout_index')]
    public function logout(): void
    {
        // O Symfony lida automaticamente com o logout, então não é necessário implementar nada aqui.
        // Esse metodo pode ser vazio.
    }
}
