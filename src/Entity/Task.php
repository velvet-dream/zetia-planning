<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table('pct_task_tsk')]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $tskId;

    #[ORM\Column(type: 'string', length: 255)]
    private string $tskTitle;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $tskDateDebut;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $tskDateFinPrevisionnelle;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTimeInterface $tskDateFinReelle;

    #[ORM\Column(type: 'text')]
    private string $tskDescription;

    #[ORM\Column(type: 'float')]
    private float $tskDuree;

    #[ORM\Column(type: 'integer')]
    private int $pctId;

    #[ORM\Column(type: 'integer')]
    private int $stkId;

    // Getters
    public function getTskId(): ?int
    {
        return $this->tskId;
    }

    public function getTskTitle(): ?string
    {
        return $this->tskTitle;
    }

    public function getTskDateDebut(): ?DateTimeInterface
    {
        return $this->tskDateDebut;
    }

    public function getTskDateFinPrevisionnelle(): ?DateTimeInterface
    {
        return $this->tskDateFinPrevisionnelle;
    }

    public function getTskDescription(): ?string
    {
        return $this->tskDescription;
    }

    public function getTskDateFinReelle(): ?DateTimeInterface
    {
        return $this->tskDateFinReelle;
    }

    public function getTskDuree(): ?float
    {
        return $this->tskDuree;
    }

    public function getPctId(): ?int
    {
        return $this->pctId;
    }

    public function getStkId(): ?int
    {
        return $this->stkId;
    }

    // Setters
    public function setTskId(int $tskId): self
    {
        $this->tskId = $tskId;

        return $this;
    }

    public function setTskTitle(string $tskTitle): self
    {
        $this->tskTitle = $tskTitle;

        return $this;
    }

    public function setTskDateDebut(DateTimeInterface $tskDateDebut): self
    {
        $this->tskDateDebut = $tskDateDebut;

        return $this;
    }

    public function setTskDateFinPrevisionnelle(DateTimeInterface $tskDateFinPrevisionnelle): self
    {
        $this->tskDateFinPrevisionnelle = $tskDateFinPrevisionnelle;

        return $this;
    }

    public function setTskDescription(string $tskDescription): self
    {
        $this->tskDescription = $tskDescription;

        return $this;
    }

    public function setTskDateFinReelle(DateTimeInterface $tskDateFinReelle): self
    {
        $this->tskDateFinReelle = $tskDateFinReelle;

        return $this;
    }

    public function setTskDuree(float $tskDuree): self
    {
        $this->tskDuree = $tskDuree;

        return $this;
    }

    public function setPctId(int $pctId): self
    {
        $this->pctId = $pctId;

        return $this;
    }

    public function setStkId(int $stkId): self
    {
        $this->stkId = $stkId;

        return $this;
    }
}
