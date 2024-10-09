<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_reserva = null;

    #[ORM\Column]
    private ?int $id_usuario = null;

    #[ORM\Column]
    private ?int $id_livro = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data_reserva = null;

    #[ORM\Column(length: 255)]
    private ?string $status_reserva = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdReserva(): ?int
    {
        return $this->id_reserva;
    }

    public function setIdReserva(int $id_reserva): static
    {
        $this->id_reserva = $id_reserva;

        return $this;
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

    public function getDataReserva(): ?\DateTimeInterface
    {
        return $this->data_reserva;
    }

    public function setDataReserva(\DateTimeInterface $data_reserva): static
    {
        $this->data_reserva = $data_reserva;

        return $this;
    }

    public function getStatusReserva(): ?string
    {
        return $this->status_reserva;
    }

    public function setStatusReserva(string $status_reserva): static
    {
        $this->status_reserva = $status_reserva;

        return $this;
    }
}
