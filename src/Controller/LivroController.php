<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Livro;
use App\Form\LivroType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivroController extends AbstractController
{

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

            return new Response('Livro adicionado com sucesso!');
        }

        $data['titulo'] = 'Adicionar novo título';
        $data['autor'] = 'Adicionar autor';
        $data['edicao'] = 'Adicionar edição';
        $data['editora'] = 'Adicionar editora';
        $data['ano_publicacao'] = date('YYYY');
        $data['cod_isbn'] = 'ISBN';
        $data['quantidade'] = 'Quantidade';
        $data['setor'] = 'Setor';
        $data['form'] = $form->createView();
        return $this->render('livro/index.html.twig', $data);
    }
}
