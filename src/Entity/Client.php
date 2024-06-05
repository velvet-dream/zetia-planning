<?php

// src/Entity/Client.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $cltId;

    #[ORM\Column(type: 'string', length: 50)]
    private string $cltName;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private?string $cltSiret;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private?string $cltPhone;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private?string $cltMail;

    public function getCltId():?int
    {
        return $this->cltId;
    }

    public function getCltName():?string
    {
        return $this->cltName;
    }

    public function setCltName(string $cltName): self
    {
        $this->cltName = $cltName;

        return $this;
    }

    // Ajoutez des getters et setters pour cltSiret, cltPhone, et cltMail
}
