<?php

namespace App\Entity;

use App\Repository\EmprestimoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmprestimoRepository::class)]
class Emprestimo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_emprestimo = null;

    #[ORM\Column]
    private ?int $id_usuario = null;

    #[ORM\Column]
    private ?int $id_livro = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data_emprestimo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data_devolucao = null;

    #[ORM\Column]
    private ?int $renovacoes = null;

    #[ORM\Column]
    private ?int $pendencias = null;
    
    public function getIdEmprestimo(): ?int
    {
        return $this->id_emprestimo;
    }
    
    public function getIdUsuario(): ?int
    {
        return $this->id_usuario;
    }

    public function setIdUsuario(int $id_usuario): static
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }

    public function getIdLivro(): ?int
    {
        return $this->id_livro;
    }

    public function setIdLivro(int $id_livro): static
    {
        $this->id_livro = $id_livro;

        return $this;
    }

    public function getDataEmprestimo(): ?\DateTimeInterface
    {
        return $this->data_emprestimo;
    }

    public function setDataEmprestimo(\DateTimeInterface $data_emprestimo): static
    {
        $this->data_emprestimo = $data_emprestimo;

        return $this;
    }

    public function getDataDevolucao(): ?\DateTimeInterface
    {
        return $this->data_devolucao;
    }

    public function setDataDevolucao(\DateTimeInterface $data_devolucao): static
    {
        $this->data_devolucao = $data_devolucao;

        return $this;
    }

    public function getRenovacoes(): ?int
    {
        return $this->renovacoes;
    }

    public function setRenovacoes(int $renovacoes): static
    {
        $this->renovacoes = $renovacoes;

        return $this;
    }

    public function getPendencias(): ?int
    {
        return $this->pendencias;
    }

    public function setPendencias(int $pendencias): static
    {
        $this->pendencias = $pendencias;

        return $this;
    }

    public function setLivro(Livro $livro): static
    {
        $this->id_livro = $livro->getId();
        return $this;
    }

    public function setUsuario(Usuario $cliente): static
    {
        $this->id_usuario = $cliente->getId();
        return $this;
    }
}
