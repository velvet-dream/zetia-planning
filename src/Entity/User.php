<?php 
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: 'App\Repository\UserRepository')]
#[ORM\Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue] 
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $usr_name;

    #[ORM\Column(type: 'string', length: 255)]
    private string $usr_first_name;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private string $usr_mail;

    #[ORM\Column(type: 'string', length: 255)]
    private string $usr_password;

    #[ORM\Column(type: 'string', length: 50 , nullable: true)]
    private ?string $usrRole; 

    #[ORM\Column(type: 'integer' ,nullable: true)]
    private ?int $pstId;

    // Getters and Setters
    public function getUserIdentifier(): string
    {
        return $this->usr_mail;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsrName(): ?string
    {
        return $this->usr_name;
    }

    public function setUsrName(string $usrName): self
    {
        $this->usr_name = $usrName;
        return $this;
    }

    public function getUsrFirstName(): ?string
    {
        return $this->usr_first_name;
    }

    public function setUsrFirstName(string $usrFirstName): self
    {
        $this->usr_first_name = $usrFirstName;
        return $this;
    }

    public function getUsrMail(): ?string
    {
        return $this->usr_mail;
    }

    public function getUsername(): string
    {
        return $this->usr_mail;
    }

    public function setUsrMail(string $usrMail): self
    {
        $this->usr_mail = $usrMail;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->usr_password;
    }

    public function setUsrPassword(string $usrPassword): self
    {
        $this->usr_password = $usrPassword;
        return $this;
    }

    public function getUsrRole(): ?string
    {
        return $this->usrRole;
    }

    public function setUsrRole(string $usrRole): self
    {
        $this->usrRole = $usrRole;
        return $this;
    }

    public function getPstId(): ?int
    {
        return $this->pstId;
    }

    public function setPstId(int $pstId): self
    {
        $this->pstId = $pstId;
        return $this;
    }

    public function getRoles(): array
    {
        return [$this->usrRole ?? 'ROLE_USER'];
    }

    public function eraseCredentials()
    {
        // Si vous stockez des données sensibles temporairement, nettoyez-les ici
        // $this->plainPassword = null;
    }
}
