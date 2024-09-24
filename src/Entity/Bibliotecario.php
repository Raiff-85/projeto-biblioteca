<?php

namespace App\Entity;

use App\Repository\BibliotecarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: BibliotecarioRepository::class)]
#[UniqueEntity(fields: ['login'], message: 'O nome de usuário já existe.')]
class Bibliotecario
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Geração automática
    #[ORM\Column(type: 'integer')]
    private ?int $id_bibliotecario = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data_admissao = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $senha = null;

    public function getIdBibliotecario(): ?int
    {
        return $this->id_bibliotecario;
    }

    public function setIdBibliotecario(int $id_bibliotecario): static
    {
        $this->id_bibliotecario = $id_bibliotecario;

        return $this;
    }

    public function getDataAdmissao(): ?\DateTimeInterface
    {
        return $this->data_admissao;
    }

    public function setDataAdmissao(\DateTimeInterface $data_admissao): static
    {
        $this->data_admissao = $data_admissao;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): static
    {
        $this->senha = $senha;

        return $this;
    }
}
