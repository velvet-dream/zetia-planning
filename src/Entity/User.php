<?php

// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $usrId;

    #[ORM\Column(type: 'string', length: 90)]
    private string $usrName;

    #[ORM\Column(type: 'string', length: 50)]
    private string $usrFirstName;

    #[ORM\Column(type: 'string', length: 50)]
    private string $usrMail;

    #[ORM\Column(type: 'string', length: 150)]
    private string $usrPassword;

    #[ORM\Column(type: 'string', length: 250)]
    private string $usrRole;

    #[ORM\Column(type: 'integer')]
    private int $pstId;

    public function getUsrId():?int
    {
        return $this->usrId;
    }

    public function getUsrName():?string
    {
        return $this->usrName;
    }

    public function getUsrFirstName():?string
    {
        return $this->usrFirstName;
    }

    public function getUsrMail():?string
    {
        return $this->usrMail;
    }

    public function getUsrPassword():?string
    {
        return $this->usrPassword;
    }

    public function getUsrRole():?string
    {
        return $this->usrRole;
    }

    public function getPstId():?int
    {
        return $this->pstId;
    }

    public function setPstId(int $pstId): self
    {
        $this->pstId = $pstId;

        return $this;
    }

    // Ajoutez des setters pour les autres champs si nécessaire
}
