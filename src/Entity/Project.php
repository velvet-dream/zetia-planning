<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private $title;
    #[ORM\Column]
    private $description;

    public function getId(): ?int
        {
            return $this->id;
        }
    public function getTitle():?string
        {
            return $this->title;
        }
    
    public function setTitle(string $title): self
        {
            $this->title = $title;
    
            return $this;
        }

        public function getDescription(): ?string
        {
            return $this->description;
        }
        public function setDescription(string $description): void
        {
            $this->description = $description;
        }
    }