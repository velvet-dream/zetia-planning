<?php

namespace App\Entity;

use App\Repository\OrganizationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrganizationRepository::class)]
#[ORM\Table(name: 'organization_org')]
class Organization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $orgId = null;

    #[ORM\Column(length: 255)]
    private ?string $orgName = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\JoinTable(name: 'organizationusers_ous')]
    #[ORM\JoinColumn(referencedColumnName: 'org_id', name: 'org_id')]
    #[ORM\InverseJoinColumn(referencedColumnName: 'usr_id', name: 'usr_id')]
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'usrOrganizations')]
    private Collection $orgMembers;

    public function __construct()
    {
        $this->orgMembers = new ArrayCollection();
    }

    public function getOrgId(): ?int
    {
        return $this->orgId;
    }

    public function getOrgName(): ?string
    {
        return $this->orgName;
    }

    public function setOrgName(string $orgName): static
    {
        $this->orgName = $orgName;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getOrgMembers(): Collection
    {
        return $this->orgMembers;
    }

    public function addOrgMember(User $orgMember): static
    {
        if (!$this->orgMembers->contains($orgMember)) {
            $this->orgMembers->add($orgMember);
        }

        return $this;
    }

    public function removeOrgMember(User $orgMember): static
    {
        $this->orgMembers->removeElement($orgMember);

        return $this;
    }
}
