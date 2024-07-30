<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'user_usr')]
#[UniqueEntity(fields: ['usr_mail'], message: 'There is already an account with this email adress')]
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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'job_id', name: 'job_id')]
    private ?Job $job = null;

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

    public function setUsrId(int $usr_id): self
    {
        $this->usr_id = $usr_id;
        return $this;
    }

    public function getUsrName(): ?string
    {
        return $this->usr_name;
    }

    public function setUsrName(string $usr_name): self
    {
        $this->usr_name = $usr_name;
        return $this;
    }

    public function getUsrFirstName(): ?string
    {
        return $this->usr_first_name;
    }

    public function setUsrFirstName(string $usr_first_name): self
    {
        $this->usr_first_name = $usr_first_name;
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

    public function setPassword(string $usr_password): self
    {
        $this->usr_password = $usr_password;
        return $this;
    }

    public function getUsrRole(): ?string
    {
        return $this->usr_role;
    }

    public function setUsrRole(string $usr_role): self
    {
        $this->usr_role = $usr_role;
        return $this;
    }

    public function getUsrAvatar(): ?string
    {
        return $this->usr_avatar;
    }

    public function setUsrAvatar(?string $usr_avatar): static
    {
        $this->usr_avatar = $usr_avatar;
        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): static
    {
        $this->job = $job;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): static
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks->add($task);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        $this->tasks->removeElement($task);

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getManagedProjects(): Collection
    {
        return $this->managedProjects;
    }

    public function addManagedProject(Project $managedProject): static
    {
        if (!$this->managedProjects->contains($managedProject)) {
            $this->managedProjects->add($managedProject);
            $managedProject->setProjectAdmin($this);
        }

        return $this;
    }

    public function removeManagedProject(Project $managedProject): static
    {
        if ($this->managedProjects->removeElement($managedProject)) {
            // set the owning side to null (unless already changed)
            if ($managedProject->getProjectAdmin() === $this) {
                $managedProject->setProjectAdmin(null);
            }
        }

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
