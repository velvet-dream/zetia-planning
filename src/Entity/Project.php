<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\Table(name: 'usr_project_pct')]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $pctId;

    #[ORM\Column(type: 'string', length: 127)]
    private $pctTitle;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pctDescription = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $pctDateDebut = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $pctDateFinPrevisionnelle = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $pctDateFinReelle = null;

    #[ORM\ManyToOne(inversedBy: 'managedProjects')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'usr_id', name: 'usr_id')]
    private ?User $projectAdmin = null;

    /**
     * @var Collection<int, Task>
     */
    #[ORM\OneToMany(targetEntity: Task::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $tasks;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: 'stp_id', name: 'stp_id')]
    private ?StatusProject $pctStatus = null;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

    public function getPctId(): ?int
    {
        return $this->pctId;
    }

    public function getPctTitle(): ?string
    {
        return $this->pctTitle;
    }

    public function setPctTitle(string $pctTitle): self
    {
        $this->pctTitle = $pctTitle;

        return $this;
    }

    public function getPctDescription(): ?string
    {
        return $this->pctDescription;
    }

    public function setPctDescription(?string $pctDescription): static
    {
        $this->pctDescription = $pctDescription;

        return $this;
    }

    public function getPctDateDebut(): ?\DateTimeImmutable
    {
        return $this->pctDateDebut;
    }

    public function setPctDateDebut(\DateTimeImmutable $pctDateDebut): static
    {
        $this->pctDateDebut = $pctDateDebut;

        return $this;
    }

    public function getPctDateFinPrevisionnelle(): ?\DateTimeImmutable
    {
        return $this->pctDateFinPrevisionnelle;
    }

    public function setPctDateFinPrevisionnelle(?\DateTimeImmutable $pctDateFinPrevisionnelle): static
    {
        $this->pctDateFinPrevisionnelle = $pctDateFinPrevisionnelle;

        return $this;
    }

    public function getPctDateFinReelle(): ?\DateTimeImmutable
    {
        return $this->pctDateFinReelle;
    }

    public function setPctDateFinReelle(?\DateTimeImmutable $pctDateFinReelle): static
    {
        $this->pctDateFinReelle = $pctDateFinReelle;

        return $this;
    }

    public function getProjectAdmin(): ?User
    {
        return $this->projectAdmin;
    }

    public function setProjectAdmin(?User $projectAdmin): static
    {
        $this->projectAdmin = $projectAdmin;

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
            $task->setProject($this);
        }

        return $this;
    }

    public function removeTask(Task $task): static
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getProject() === $this) {
                $task->setProject(null);
            }
        }

        return $this;
    }

    public function getPctStatus(): ?StatusProject
    {
        return $this->pctStatus;
    }

    public function setPctStatus(?StatusProject $pctStatus): static
    {
        $this->pctStatus = $pctStatus;

        return $this;
    }
}
