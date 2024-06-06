<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
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
}
