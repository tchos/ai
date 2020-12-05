<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegulInvCloRepository")
 * @ORM\HasLifecycleCallbacks
 *
 * L'acte d'une pension de réversion pour un agent doit être unique
 * @UniqueEntity(
 *      fields = {"numActeInval"},
 *      message = "Cet acte de réversion a déjà été enregistré."
 * )
 */
class RegulInvClo
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
     * @Assert\Length(min="4",
     *  minMessage="Vous devez entrer le numéro de l'acte attribuant la pension de réversion.")
     */
    private $numActeInval;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRegul;

    /**
     * @ORM\Column(type="integer")
     */
    private $cc;

    /**
     * @ORM\Column(type="integer")
     */
    private $resultat;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $regulariser_y_n;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="regulInvClos")
     */
    private $agentSaisie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateNaisDerOrph;

    /**
     * CallBack appelé à chaque fois que l'on veut enregistrer un acte d'invalidité pour
     * calculer automatiquement la date de saisie, le résultat et l'agent de saisie.     *.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function prePersist()
    {
        if (empty($this->dateRegul) || $this->dateRegul === null) {
            $this->dateRegul = new \DateTime();
        }
    }

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

    public function getDateRegul(): ?\DateTimeInterface
    {
        return $this->dateRegul;
    }

    public function setDateRegul(?\DateTimeInterface $dateRegul): self
    {
        $this->dateRegul = $dateRegul;

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

    public function getRegulariserYN(): ?bool
    {
        return $this->regulariser_y_n;
    }

    public function setRegulariserYN(?bool $regulariser_y_n): self
    {
        $this->regulariser_y_n = $regulariser_y_n;

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

    public function getDateNaisDerOrph(): ?\DateTimeInterface
    {
        return $this->DateNaisDerOrph;
    }

    public function setDateNaisDerOrph(?\DateTimeInterface $DateNaisDerOrph): self
    {
        $this->DateNaisDerOrph = $DateNaisDerOrph;

        return $this;
    }
}
