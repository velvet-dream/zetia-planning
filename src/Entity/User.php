<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'app_user_usr')]
class User
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
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'jobId')]
    private ?Job $job = null;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\JoinTable(name: 'ass_usertask_uts')]
    #[ORM\JoinColumn(referencedColumnName: 'usrId')]
    #[ORM\InverseJoinColumn(referencedColumnName: 'tskId')]
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

    public function getUsrName(): ?string
    {
        return $this->usrName;
    }

    public function getUsrFirstName(): ?string
    {
        return $this->usrFirstName;
    }

    public function getUsrMail(): ?string
    {
        return $this->usrMail;
    }

    public function getUsrPassword(): ?string
    {
        return $this->usrPassword;
    }

    public function getUsrRole(): ?string
    {
        return $this->usrRole;
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
}
