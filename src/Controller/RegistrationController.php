<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register_index')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Usuario();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Passa os dados de usuário para o foprmulário
            $user->setNome($form->get('nome')->getData());
            $user->setCpf($form->get('cpf')->getData());
            $user->setTelefone($form->get('telefone')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setTipo($form->get('tipo')->getData());
            $user->setPassword($form->get('password')->getData());
            $user->setConfirmePassword($form->get('confirmePassword')->getData());

            // Verifica a correspondência entre senha e confirmação antes de persistir o usuário
            if ($form->get('password')->getData() !== $form->get('confirmePassword')->getData()) {
                $this->addFlash('error', 'As senhas não correspondem.');

                return $this->redirectToRoute('login_index');
            }
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);

            // Salvar o usuário no banco de dados
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('login_index');
        }

        $data = [
            'registrationForm' => $form->createView()
        ];

        return $this->render('registration/register.html.twig', $data);
    }
}
