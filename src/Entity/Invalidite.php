<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\IsNull;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvaliditeRepository")
 */
class Invalidite
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
    private $matriculInv;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomAgentInvalide;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNais;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numActeInval;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeActeInv;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSignatureInv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomsInvActe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateInvalidite;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ccInv;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $resultat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $precontentieux;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="invalidites")
     */
    private $agentSaisie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $aAffect;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSaisieInval;

    /**
     * CallBack appelé à chaque fois que l'on veut enregistrer un acte d'invalidité pour
     * calculer automatiquement la date de saisie, le résultat et l'agent de saisie.     * 
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function prePersist()
    {
        if (empty($this->dateSaisieInval) || $this->dateSaisieInval === null) {
            $this->dateSaisieInval = new \DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculInv(): ?string
    {
        return $this->matriculInv;
    }

    public function setMatriculInv(string $matriculInv): self
    {
        $this->matriculInv = $matriculInv;

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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNais(): ?\DateTimeInterface
    {
        return $this->dateNais;
    }

    public function setDateNais(?\DateTimeInterface $dateNais): self
    {
        $this->dateNais = $dateNais;

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

    public function getTypeActeInv(): ?string
    {
        return $this->typeActeInv;
    }

    public function setTypeActeInv(?string $typeActeInv): self
    {
        $this->typeActeInv = $typeActeInv;

        return $this;
    }

    public function getDateSignatureInv(): ?\DateTimeInterface
    {
        return $this->dateSignatureInv;
    }

    public function setDateSignatureInv(?\DateTimeInterface $dateSignatureInv): self
    {
        $this->dateSignatureInv = $dateSignatureInv;

        return $this;
    }

    public function getNomsInvActe(): ?string
    {
        return $this->nomsInvActe;
    }

    public function setNomsInvActe(?string $nomsInvActe): self
    {
        $this->nomsInvActe = $nomsInvActe;

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

    public function getCcInv(): ?int
    {
        return $this->ccInv;
    }

    public function setCcInv(?int $ccInv): self
    {
        $this->ccInv = $ccInv;

        return $this;
    }

    public function getCc(): ?int
    {
        return $this->cc;
    }

    public function setCc(?int $cc): self
    {
        $this->cc = $cc;

        return $this;
    }

    public function getResultat(): ?int
    {
        return $this->resultat;
    }

    public function setResultat(?int $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getPrecontentieux(): ?int
    {
        return $this->precontentieux;
    }

    public function setPrecontentieux(?int $precontentieux): self
    {
        $this->precontentieux = $precontentieux;

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

    public function getAAffect(): ?int
    {
        return $this->aAffect;
    }

    public function setAAffect(?int $aAffect): self
    {
        $this->aAffect = $aAffect;

        return $this;
    }

    public function getDateSaisieInval(): ?\DateTimeInterface
    {
        return $this->dateSaisieInval;
    }

    public function setDateSaisieInval(?\DateTimeInterface $dateSaisieInval): self
    {
        $this->dateSaisieInval = $dateSaisieInval;

        return $this;
    }
}
