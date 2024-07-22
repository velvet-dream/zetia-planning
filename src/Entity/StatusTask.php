<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[ORM\Table(name: 'statustask_stk')]
class StatusTask
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $stkId;

    #[ORM\Column(type: 'string', length: 127)]
    private string $stkTitle;

    public function getStkId(): ?int
    {
        return $this->stkId;
    }

    public function getStkTitle(): ?string
    {
        return $this->stkTitle;
    }

    public function setStkTitle(string $stkTitle): self
    {
        $this->stkTitle = $stkTitle;

        return $this;
    }
}
