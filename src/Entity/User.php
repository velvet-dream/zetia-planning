<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
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
}
