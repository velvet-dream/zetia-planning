<?php

// src/Entity/Poste.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Poste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $pstId;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private?string $pstTitle;

    public function getPstId():?int
    {
        return $this->pstId;
    }

    public function getPstTitle():?string
    {
        return $this->pstTitle;
    }

    public function setPstTitle(?string $pstTitle): self
    {
        $this->pstTitle = $pstTitle;

        return $this;
    }
}
