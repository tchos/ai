<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AgentRepository")
 */
class Agent
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $matriculeAuteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomAuteur;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $ministereAuteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculeAuteur(): ?string
    {
        return $this->matriculeAuteur;
    }

    public function setMatriculeAuteur(string $matriculeAuteur): self
    {
        $this->matriculeAuteur = $matriculeAuteur;

        return $this;
    }

    public function getNomAuteur(): ?string
    {
        return $this->nomAuteur;
    }

    public function setNomAuteur(string $nomAuteur): self
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }

    public function getMinistereAuteur(): ?string
    {
        return $this->ministereAuteur;
    }

    public function setMinistereAuteur(?string $ministereAuteur): self
    {
        $this->ministereAuteur = $ministereAuteur;

        return $this;
    }
}
