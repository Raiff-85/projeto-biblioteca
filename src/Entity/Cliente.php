<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')] // Geração automátic
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_cliente = null;

    #[ORM\Column]
    private ?int $telefone_referencia = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCliente(): ?int
    {
        return $this->id_cliente;
    }

    public function setIdCliente(int $id_cliente): static
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }

    public function getTelefoneReferencia(): ?int
    {
        return $this->telefone_referencia;
    }

    public function setTelefoneReferencia(int $telefone_referencia): static
    {
        $this->telefone_referencia = $telefone_referencia;

        return $this;
    }
}
