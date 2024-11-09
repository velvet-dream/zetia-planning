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
#[UniqueEntity(fields: ['usrMail'], message: 'There is already an account with this email adress')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $usrId;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usrName;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usrFirstName;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usrMail;

    #[ORM\Column(type: 'string', length: 127)]
    private string $usrPassword;

    #[ORM\Column(type: 'string', length: 255)]
    private string $usrRole;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $usrAvatar = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true, referencedColumnName: 'job_id', name: 'job_id')]
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
        return $this->usrId;
    }

    public function setUsrId(int $usrId): self
    {
        $this->usrId = $usrId;
        return $this;
    }

    public function getUsrName(): ?string
    {
        return $this->usrName;
    }

    public function setUsrName(string $usrName): self
    {
        $this->usrName = $usrName;
        return $this;
    }

    public function getUsrFirstName(): ?string
    {
        return $this->usrFirstName;
    }

    public function setUsrFirstName(string $usrFirstName): self
    {
        $this->usrFirstName = $usrFirstName;
        return $this;
    }

    public function getUsrMail(): ?string
    {
        return $this->usrMail;
    }

    public function setUsrMail(string $usrMail): self
    {
        $this->usrMail = $usrMail;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->usrPassword;
    }

    public function setPassword(string $usrPassword): self
    {
        $this->usrPassword = $usrPassword;
        return $this;
    }

    public function getUsrRole(): ?string
    {
        return $this->usrRole;
    }

    public function setUsrRole(string $usrRole): self
    {
        $this->usrRole = $usrRole;
        return $this;
    }

    public function getUsrAvatar(): ?string
    {
        return $this->usrAvatar;
    }

    public function setUsrAvatar(?string $usrAvatar): static
    {
        $this->usrAvatar = $usrAvatar;
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

    public function getAssignedProjects(): Collection
    {
        $tasks = $this->getTasks();
        $projects = new ArrayCollection();
        foreach ($tasks as $task) {
            $project = $task->getProject();
            $projects->add($project);
        }
        return $projects;
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
        return $this->usrPassword;
    }

    public function getSalt(): ?string
    {
        // Not needed for modern hashing algorithms
        return null;
    }

    public function getUsername(): string
    {
        return $this->usrMail;
    }

    public function getRoles(): array
    {
        // Assuming roles are stored as a simple string
        return [$this->usrRole];
    }

    public function getUserIdentifier(): string
    {
        return $this->usrMail;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
