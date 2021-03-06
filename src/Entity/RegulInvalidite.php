<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegulInvaliditeRepository")
 */
class RegulInvalidite
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
    private $matricul;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomAgentInvalide;

    /**
     * @ORM\Column(type="integer")
     */
    private $aAffect;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numActeInval;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeActe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSignature;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomInvActe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateInvalidite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaisDerOrph;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $cloture_y_n;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $regulariser_y_n;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRegul;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="regulInvalidites")
     */
    private $agentSaisie;

    /**
     * @ORM\Column(type="integer")
     */
    private $cc;

    /**
     * @ORM\Column(type="integer")
     */
    private $resultat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricul(): ?string
    {
        return $this->matricul;
    }

    public function setMatricul(string $matricul): self
    {
        $this->matricul = $matricul;

        return $this;
    }

    public function getNomAgentInvalide(): ?string
    {
        return $this->nomAgentInvalide;
    }

    public function setNomAgentInvalide(string $nomAgentInvalide): self
    {
        $this->nomAgentInvalide = $nomAgentInvalide;

        return $this;
    }

    public function getAAffect(): ?int
    {
        return $this->aAffect;
    }

    public function setAAffect(int $aAffect): self
    {
        $this->aAffect = $aAffect;

        return $this;
    }

    public function getNumActeInval(): ?string
    {
        return $this->numActeInval;
    }

    public function setNumActeInval(?string $numActeInval): self
    {
        $this->numActeInval = $numActeInval;

        return $this;
    }

    public function getTypeActe(): ?string
    {
        return $this->typeActe;
    }

    public function setTypeActe(?string $typeActe): self
    {
        $this->typeActe = $typeActe;

        return $this;
    }

    public function getDateSignature(): ?\DateTimeInterface
    {
        return $this->dateSignature;
    }

    public function setDateSignature(?\DateTimeInterface $dateSignature): self
    {
        $this->dateSignature = $dateSignature;

        return $this;
    }

    public function getNomInvActe(): ?string
    {
        return $this->nomInvActe;
    }

    public function setNomInvActe(?string $nomInvActe): self
    {
        $this->nomInvActe = $nomInvActe;

        return $this;
    }

    public function getDateInvalidite(): ?\DateTimeInterface
    {
        return $this->dateInvalidite;
    }

    public function setDateInvalidite(?\DateTimeInterface $dateInvalidite): self
    {
        $this->dateInvalidite = $dateInvalidite;

        return $this;
    }

    public function getDateNaisDerOrph(): ?\DateTimeInterface
    {
        return $this->dateNaisDerOrph;
    }

    public function setDateNaisDerOrph(?\DateTimeInterface $dateNaisDerOrph): self
    {
        $this->dateNaisDerOrph = $dateNaisDerOrph;

        return $this;
    }

    public function getClotureYN(): ?bool
    {
        return $this->cloture_y_n;
    }

    public function setClotureYN(?bool $cloture_y_n): self
    {
        $this->cloture_y_n = $cloture_y_n;

        return $this;
    }

    public function getRegulariserYN(): ?bool
    {
        return $this->regulariser_y_n;
    }

    public function setRegulariserYN(?bool $regulariser_y_n): self
    {
        $this->regulariser_y_n = $regulariser_y_n;

        return $this;
    }

    public function getDateRegul(): ?\DateTimeInterface
    {
        return $this->dateRegul;
    }

    public function setDateRegul(\DateTimeInterface $dateRegul): self
    {
        $this->dateRegul = $dateRegul;

        return $this;
    }

    public function getAgentSaisie(): ?User
    {
        return $this->agentSaisie;
    }

    public function setAgentSaisie(?User $agentSaisie): self
    {
        $this->agentSaisie = $agentSaisie;

        return $this;
    }

    public function getCc(): ?int
    {
        return $this->cc;
    }

    public function setCc(int $cc): self
    {
        $this->cc = $cc;

        return $this;
    }

    public function getResultat(): ?int
    {
        return $this->resultat;
    }

    public function setResultat(int $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }
}
