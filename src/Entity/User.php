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
    #[ORM\JoinColumn(nullable: true, referencedColumnName: 'job_id', name: 'job_id')]
    private ?Job $job = null;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\JoinTable(name: 'usertask_uts')]
    #[ORM\JoinColumn(referencedColumnName: 'usr_id', name: 'usr_id')]
    #[ORM\InverseJoinColumn(referencedColumnName: 'tsk_id', name: 'tsk_id')]
    #[ORM\ManyToMany(targetEntity: Task::class, inversedBy: 'user')]
    private Collection $tasks;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'projectAdmin', orphanRemoval: true)]
    private Collection $managedProjects;

    /**
     * @var Collection<int, Organization>
     */
    #[ORM\ManyToMany(targetEntity: Organization::class, mappedBy: 'orgMembers')]
    private Collection $usrOrganizations;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->managedProjects = new ArrayCollection();
        $this->usrOrganizations = new ArrayCollection();
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

    public function setUsrId(int $usrId): self
    {
        $this->usrId = $usrId;
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

    public function setUsrName(string $usrName): self
    {
        $this->usrName = $usrName;
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

    public function setUsrFirstName(string $usrFirstName): self
    {
        $this->usrFirstName = $usrFirstName;
        return $this;
    }

    public function getUsrMail(): ?string
    {
        return $this->usr_mail;
    }

    public function setUsrMail(string $usrMail): self
    {
        $this->usrMail = $usrMail;
        return $this;
    }

    public function getPassword(): ?string
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

    public function setPassword(string $usrPassword): self
    {
        $this->usrPassword = $usrPassword;
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

    public function setUsrRole(string $usrRole): self
    {
        $this->usrRole = $usrRole;
        return $this;
    }

    public function getUsrAvatar(): ?string
    {
        return $this->usr_avatar;
    }

    public function setUsrAvatar(?string $usr_avatar): static
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

    /**
     * @return Collection<int, Organization>
     */
    public function getUsrOrganizations(): Collection
    {
        return $this->usrOrganizations;
    }

    public function addUsrOrganization(Organization $usrOrganization): static
    {
        if (!$this->usrOrganizations->contains($usrOrganization)) {
            $this->usrOrganizations->add($usrOrganization);
            $usrOrganization->addOrgMember($this);
        }

        return $this;
    }

    public function removeUsrOrganization(Organization $usrOrganization): static
    {
        if ($this->usrOrganizations->removeElement($usrOrganization)) {
            $usrOrganization->removeOrgMember($this);
        }

        return $this;
    }
}
