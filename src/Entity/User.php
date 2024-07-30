<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Table(name: 'app_user_usr')]
#[UniqueEntity(fields: ['usr_mail'], message: 'There is already an account with this usr_mail')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $usr_id;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usr_name;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usr_first_name;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usr_mail;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usr_password;

    #[ORM\Column(type: 'string', length: 255)]
    private string $usr_role;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $usr_avatar = null;



    /**
     * @var Collection<int, Task>
     */
    #[ORM\JoinTable(name: 'usertask')]
    #[ORM\JoinColumn(referencedColumnName: 'usr_id', name: 'usr_id')]
    #[ORM\InverseJoinColumn(referencedColumnName: 'tsk_id', name: 'tsk_id')]
    #[ORM\ManyToMany(targetEntity: Task::class, inversedBy: 'user')]
    private Collection $tasks;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'projectAdmin', orphanRemoval: true)]
    private Collection $managedProjects;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->managedProjects = new ArrayCollection();
    }

    public function getUsrId(): ?int
    {
        return $this->usr_id;
    }

    public function getId(): ?int
    {
        return $this->usr_id;
    }

    public function getUsrName(): ?string
    {
        return $this->usr_name;
    }

    public function setUsrName(string $usrName): self
    {
        $this->usr_name = $usrName;
        return $this;
    }

    public function getUsrFirstName(): ?string
    {
        return $this->usr_first_name;
    }

    public function setUsrFirstName(string $usrFirstName): self
    {
        $this->usr_first_name = $usrFirstName;
        return $this;
    }

    public function getUsrMail(): ?string
    {
        return $this->usr_mail;
    }

    public function setUsrMail(string $usr_mail): self
    {
        $this->usr_mail = $usr_mail;
        return $this;
    }


    public function getPassword(): ?string
    {
        return $this->usr_password;
    }

    public function setPassword(string $usrPassword): self
    {
        $this->usr_password = $usrPassword;
        return $this;
    }

    public function getUsrRole(): ?string
    {
        return $this->usr_role;
    }
    public function setUsrRole(string $usrRole): self
    {
        $this->usr_role = $usrRole;
        return $this;
    }


    public function getPasswordHash(): string
    {
        return $this->usr_password;
    }

    public function getSalt(): ?string
    {
        // Not needed for modern hashing algorithms
        return null;
    }

    public function getUsername(): string
    {
        return $this->usr_mail;
    }

    public function getRoles(): array
    {
        // Assuming roles are stored as a simple string
        return [$this->usr_role];
    }
    public function getUserIdentifier(): string
    {
        return $this->usr_mail;
    }
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
