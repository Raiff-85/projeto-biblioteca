<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Livro;
use App\Form\LivroType;
use App\Repository\LivroRepository;
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
     * @Route("/livro", name="livro_index", methods={"GET"})
     */
    public function index(LivroRepository $livroRepository): Response
    {
        return $this->render('livro/livro.html.twig', [
            'livros' => $livroRepository->findAll()
        ]);
    }

    /**
     * @Route("/livro/adicionar", name="livro_adicionar")
     */
    public function adicionar(Request $request, EntityManagerInterface $entityManager): Response
    {
        $livro = new Livro();
        $form = $this->createForm(LivroType::class, $livro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livro);    //Salva apenas na memória.
            $entityManager->flush();    //Persiste no banco de dados.

            return new Response('Livro adicionado com sucesso.');
        }

        $data['titulo'] = 'Adicionar título';
        $data['autor'] = 'Adicionar autor';
        $data['edicao'] = 'Adicionar edição';
        $data['editora'] = 'Adicionar editora';
        $data['ano_publicacao'] = date('YYYY');
        $data['cod_isbn'] = 'ISBN';
        $data['quantidade'] = 'Quantidade';
        $data['setor'] = 'Setor';
        $data['form'] = $form->createView();
        return $this->render('livro/adicionar_livro.html.twig', $data);
    }

    /**
     * @Route("/livro/buscar", name="livro_buscar")
     */
    public function buscar(Request $request, LivroRepository $livroRepository, EntityManagerInterface $entityManager): Response
    {   //dd($request->request->get('livro'));
        $livros = [];
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

            // Faz a busca no banco de dados
            $livros = $livroRepository->buscarPorTituloOuAutor($termo);
        }

        // Verifica se foram encontrados livros
        if (empty($livros)) {
            return $this->render('livro/buscar.html.twig', [
                'form' => $form->createView(),
                'livros' => $livros,
            ]);
        }

        return $this->render('livro/buscar.html.twig', [
            'form' => $form->createView(),
            'livros' => $livros,
        ]);
    }
}
