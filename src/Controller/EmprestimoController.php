<?php

namespace App\Controller;

use App\Entity\Emprestimo;
use App\Repository\LivroRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EmprestimoController extends AbstractController
{
    /**
     * @Route("/emprestar", name="emprestar_livro")
     */
    public function pegarLivro(
        Request $request,
        LivroRepository $livroRepository
    ): Response
    {
        // Formulário para buscar livros
        $formLivro = $this->createFormBuilder()
            ->add('titulo', TextType::class, [
                'label' => 'Buscar Livro por Título ou Autor:',
                'required' => false,
            ])
            ->add('buscar', SubmitType::class, [
                'label' => 'Buscar',
            ])
            ->getForm();

        $formLivro->handleRequest($request);
        $livros = [];

        if ($formLivro->isSubmitted() && $formLivro->isValid()) {
            $titulo = $formLivro->get('titulo')->getData();

            if (empty($titulo)) {
                $this->addFlash('error', 'O campo de busca não pode estar vazio.');
            } else {
                // Busca livros por título ou autor
                $livros = $livroRepository->buscarPorTituloOuAutor($titulo);
                if (empty($livros)) {
                    $this->addFlash('error', 'Sem correspondência para sua busca.');
                }
            }
        }

        return $this->render('emprestimo/pegar_livro.html.twig', [
            'formLivro' => $formLivro->createView(),
            'livros' => $livros
        ]);
    }

    /**
     * @Route("/emprestar/{id_livro}", name="realizar_emprestimo")
     */
    public function realizarEmprestimo(
        int $id_livro,
        Request $request,
        LivroRepository $livroRepository,
        UsuarioRepository $usuarioRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $livro = $livroRepository->find($id_livro);

        if (!$livro) {
            throw $this->createNotFoundException('Livro não encontrado.');
        }

        // Formulário para associar o livro a cliente
        $formCliente = $this->createFormBuilder()
            ->add('cpfCliente', TextType::class, [
                'label' => 'CPF do Cliente',
                'required' => true,
            ])
            ->add('nomeCliente', TextType::class, [
                'label' => 'Nome do Cliente',
                'required' => false,
            ])
            ->add('emprestar', SubmitType::class, [
                'label' => 'Realizar Empréstimo',
            ])
            ->getForm();

        $formCliente->handleRequest($request);
        $mensagem = null;

        if ($formCliente->isSubmitted() && $formCliente->isValid()) {
            $cpfCliente = $formCliente->get('cpfCliente')->getData();
            $cliente = $usuarioRepository->findOneBy(['cpf' => $cpfCliente]);

            if (!$cliente) {
                $mensagem = 'Cliente não encontrado.';
            } elseif ($livro->getQuantidade() == 0) {
                $mensagem = 'Não há exemplares disponíveis.';
            } else {
                // Realizando o empréstimo
                $emprestimo = new Emprestimo();
                $emprestimo->setLivro($livro);
                $emprestimo->setUsuario($cliente);
                $emprestimo->setDataEmprestimo(new \DateTime());

                // Decrementa a quantidade de exemplares disponíveis
                $livro->setQuantidade($livro->getQuantidade() - 1);

                // Persiste no banco de dados
                $entityManager->persist($emprestimo);
                $entityManager->persist($livro);
                $entityManager->flush();

                $mensagem = 'Empréstimo realizado com sucesso!';
            }
        }

        return $this->render('emprestimo/emprestar.html.twig', [
            'livro' => $livro,
            'formCliente' => $formCliente->createView(),
            'mensagem' => $mensagem,
        ]);
    }

    /**
     * @Route("/buscar-cliente", name="buscar_cliente", methods={"POST"})
     */
    public function buscarCliente(Request $request, UsuarioRepository $usuarioRepository): JsonResponse
    {
        $cpf = $request->request->get('cpf');
        $nome = $request->request->get('nome');

        // Se o CPF for enviado, buscamos pelo CPF
        if ($cpf) {
            $cliente = $usuarioRepository->findOneBy(['cpf' => $cpf]);
        }
        // Se o nome for enviado, buscamos pelo nome
        elseif ($nome) {
            $cliente = $usuarioRepository->findOneBy(['nome' => $nome]);
        } else {
            return new JsonResponse(['error' => 'Parâmetro inválido'], 400);
        }

        // Se não encontrar o cliente
        if (!$cliente) {
            return new JsonResponse(['error' => 'Cliente não encontrado'], 404);
        }

        // Retornando os dados do cliente encontrados
        return new JsonResponse([
            'nome' => $cliente->getNome(),
            'cpf' => $cliente->getCpf(),
        ]);
    }
}