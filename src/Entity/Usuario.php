<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_usuario = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * Este campo é usado apenas para a confirmação da senha no formulário.
     * Não é mapeado no banco de dados.
     *
     * @Assert\Expression(
     *     "this.getPassword() === this.getConfirmePassword()",
     * )
     */
    private ?string $confirmePassword = null;

    #[ORM\Column(length: 255)]
    private string $nome;
    #[ORM\Column]
    private string $cpf;

    #[ORM\Column]
    private ?int $telefone = null;

    #[ORM\Column]
    private ?int $Tipo = null;

    public function getId(): ?int
    {
        return $this->id_usuario;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getConfirmePassword(): ?string
    {
        return $this->confirmePassword;
    }

    public function setConfirmePassword(?string $confirmePassword): self
    {
        $this->confirmePassword = $confirmePassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

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

    public function getCpf(): ?int
    {
        return $this->cpf;
    }

    public function setCpf(int $cpf): static
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getTelefone(): ?int
    {
        return $this->telefone;
    }

    public function setTelefone(int $telefone): static
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->Tipo;
    }

    public function setTipo(int $Tipo): static
    {
        $this->Tipo = $Tipo;

        return $this;
    }
}
