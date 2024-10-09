<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Livro;
use App\Form\LivroType;
use App\Repository\LivroRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivroController extends AbstractController
{
    /**
     * @Route("/gerenciar", name="gerenciar_livro", methods={"GET"})
     */
    public function index(LivroRepository $livroRepository): Response
    {
        return $this->render('livro/gerenciar.html.twig', [
            'livros' => $livroRepository->findAll()
        ]);
    }

    /**
     * @Route("/gerenciar/adicionar", name="adicionar_livro")
     */
    public function adicionar(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $livro = new Livro();
        $form = $this->createForm(LivroType::class, $livro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($livro);    //Salva apenas na memória.
                $entityManager->flush();    //Persiste no banco de dados.

                $this->addFlash('success','Livro adicionado com sucesso.');
                return $this->redirectToRoute('gerenciar_livro');

            } catch (UniqueConstraintViolationException $e) {
                $this->addFlash('error', 'Este ISBN já existe.');
            }
        }

        $data['form'] = $form->createView();
        return $this->render('livro/adicionar.html.twig', $data);
    }

    /**
     * @Route("/gerenciar/buscar", name="buscar_livro")
     */
    public function buscar(Request $request, LivroRepository $livroRepository, EntityManagerInterface $entityManager): Response
    {
        $livros = [];
        $mensagem = [];
        $form = $this->createFormBuilder()
            ->add('titulo', TextType::class, [
                'label' => 'Buscar por Título ou Autor:',
                'required' => false,
            ])
            ->add('buscar', SubmitType::class, [
                'label' => 'Buscar',
            ])
            ->getForm();

        // Processa o formulário
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pega os dados do campo 'termo'
            $termo = $form->get('titulo')->getData();

            if(!empty($termo)){
                // Faz a busca no banco de dados
                $livros = $livroRepository->buscarPorTituloOuAutor($termo);
            } elseif (empty($form->get('buscar')->getData())) {
                // faz busca de campo vazio
                $mensagem = 'O campo "Buscar" não pode estar vazio.';
            }

            if (!empty($termo) && count($livros) < 1) {
                $mensagem = 'Sem correspondência para sua busca.';
            }
        }

        return $this->render('livro/buscar.html.twig', [
            'form' => $form->createView(),
            'livros' => $livros,
            'mensagem' => $mensagem,
        ]);
    }

    /**
     * @Route("/gerenciar/listar", name="listar_livro")
     */
    public function listar(LivroRepository $livroRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $livros = $livroRepository->findAll();
        return $this->render('livro/listar.html.twig',
            ['livros' => $livros]);
    }


    /**
     * @Route("/gerenciar/editar/{id_livro}", name="editar_livro")
     */
    public function editar(int $id_livro, Request $request, LivroRepository $livroRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        // Busca o livro por ID
        $livro = $livroRepository->find($id_livro);

        // Se o livro não for encontrado, exibe-se um erro 404
        if (!$livro) {
            throw $this->createNotFoundException('Livro não encontrado.');
        }

        // Cria o formulário com os dados do livro
        $form = $this->createForm(LivroType::class, $livro);
        $form->handleRequest($request);

        // Verifica se o formulário foi enviado e se os dados são válidos
        if ($form->isSubmitted() && $form->isValid()) {
            // Persiste as mudanças no banco de dados
            $entityManager->flush();

            // Adiciona uma mensagem flash e redirecionar o usuário
            $this->addFlash('success', 'Livro editado com sucesso.');

            // Redirecionamento para a página de listag de livros
            return $this->redirectToRoute('listar_livro');
        }

        // Passa os dados para a view
        return $this->renderForm('livro/editar.html.twig', [
            'titulo' => 'Editar livro',
            'form' => $form,
        ]);
    }

    /**
     * @Route("gerenciar/excluir/{id_livro}", name="excluir_livro")
     */
    public function excluir(int $id_livro, LivroRepository $livroRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $livro = $livroRepository->find($id_livro);
        $entityManager->remove($livro);     // Exclui o livro do banco de dados
        $entityManager->flush();            // persiste a exclusão
        $this->addFlash('success', 'Livro excluido com sucesso.');

        return $this->redirectToRoute('listar_livro');
    }
}
