<?php

namespace App\Entity;

use App\Repository\LivroRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivroRepository::class)]
class Livro
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id_livro = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $autor = null;

    #[ORM\Column(length: 100)]
    private ?string $edicao = null;

    #[ORM\Column(length: 255)]
    private ?string $editora = null;

    #[ORM\Column(type: 'integer')]
    private ?int $ano_publicacao = null;

    #[ORM\Column(unique: true)]
    private ?string $cod_isbn = null;

    #[ORM\Column]
    private ?int $quantidade = null;

    #[ORM\Column(length: 255)]
    private ?string $setor = null;

    public function getId(): ?int
    {
        return $this->id_livro;
    }

    public function setId(int $id_livro): static
    {
        $this->id_livro = $id_livro;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): static
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): static
    {
        $this->autor = $autor;

        return $this;
    }

    public function getEdicao(): ?string
    {
        return $this->edicao;
    }

    public function setEdicao(string $edicao): static
    {
        $this->edicao = $edicao;

        return $this;
    }

    public function getEditora(): ?string
    {
        return $this->editora;
    }

    public function setEditora(string $editora): static
    {
        $this->editora = $editora;

        return $this;
    }

    public function getAnoPublicacao(): ?int
    {
        return $this->ano_publicacao;
    }

    public function setAnoPublicacao(int $ano_publicacao): static
    {
        $this->ano_publicacao = $ano_publicacao;

        return $this;
    }

    public function getCodIsbn(): ?int
    {
        return $this->cod_isbn;
    }

    public function setCodIsbn(int $cod_isbn): static
    {
        $this->cod_isbn = $cod_isbn;

        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): static
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    public function getSetor(): ?string
    {
        return $this->setor;
    }

    public function setSetor(string $setor): static
    {
        $this->setor = $setor;

        return $this;
    }
}
