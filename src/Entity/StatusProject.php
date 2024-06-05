<?php

namespace App\Entity;

use App\Repository\StatusProjectRepository;
use Doctrine\ORM\Mapping as ORM;

// src/Entity/StatusProject.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class StatusProject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $stpId;

    #[ORM\Column(type: 'string', length: 50)]
    private string $stpTitle;

    public function getStpId():?int
    {
        return $this->stpId;
    }

    public function getStpTitle():?string
    {
        return $this->stpTitle;
    }

    public function setStpTitle(string $stpTitle): self
    {
        $this->stpTitle = $stpTitle;

        return $this;
    }
}
