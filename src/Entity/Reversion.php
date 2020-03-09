<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReversionRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * L'acte d'une pension de réversion pour un agent doit être unique
 * @UniqueEntity(
 *      fields = {"numActeRevers", "nomsAdActe"},
 *      message = "Cet acte de réversion a déjà été enregistré."
 * )
 */
class Reversion
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
    private $nomsAyantDroit;

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
    private $qualiteAyantDroit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaisDerOrph;

    /**
     * @ORM\Column(type="integer")
     */
    private $ccay;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cc;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateAffectat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomsAuteur;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     */
    private $matriculeAuteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ministere;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomsAdActe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numActeRevers;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeActe;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\GreaterThan(propertyPath="dateDeces", 
     *  message="La date à laquelle a été signé l'acte ne peut être antérieur à la date de décès !")
     * 
     * @Assert\GreaterThan(propertyPath="dateNaisDerOrph", 
     *  message="La date à laquelle a été signé l'acte ne peut être antérieur à la date de naissance 
     * du dernier orphelin mineur !")
     */
    private $dateSignatureRev;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $conforme_Y_N;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateSaisieRevers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $resultat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $precontentieux;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="reversions")
     */
    private $agentSaisie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $aAffect;

    /**
     * CallBack appelé à chaque fois que l'on veut enregistrer un acte de naissance pour
     * calculer automatiquement la date de saisie, le résultat et l'agent de saisie.     * 
     * 
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function prePersist()
    {
        if(!empty($this->dateSaisieRevers))
        {
            $this->dateSaisieRevers = new \DateTime();
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

    public function getNomsAyantDroit(): ?string
    {
        return $this->nomsAyantDroit;
    }

    public function setNomsAyantDroit(string $nomsAyantDroit): self
    {
        $this->nomsAyantDroit = $nomsAyantDroit;

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

    public function getQualiteAyantDroit(): ?string
    {
        return $this->qualiteAyantDroit;
    }

    public function setQualiteAyantDroit(?string $qualiteAyantDroit): self
    {
        $this->qualiteAyantDroit = $qualiteAyantDroit;

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

    public function getCcay(): ?int
    {
        return $this->ccay;
    }

    public function setCcay(int $ccay): self
    {
        $this->ccay = $ccay;

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

    public function getDateAffectat(): ?\DateTimeInterface
    {
        return $this->dateAffectat;
    }

    public function setDateAffectat(?\DateTimeInterface $dateAffectat): self
    {
        $this->dateAffectat = $dateAffectat;

        return $this;
    }


    public function getNomsAuteur(): ?string
    {
        return $this->nomsAuteur;
    }

    public function setNomsAuteur(?string $nomsAuteur): self
    {
        $this->nomsAuteur = $nomsAuteur;

        return $this;
    }

    public function getMatriculeAuteur(): ?string
    {
        return $this->matriculeAuteur;
    }

    public function setMatriculeAuteur(?string $matriculeAuteur): self
    {
        $this->matriculeAuteur = $matriculeAuteur;

        return $this;
    }

    public function getMinistere(): ?string
    {
        return $this->ministere;
    }

    public function setMinistere(?string $ministere): self
    {
        $this->ministere = $ministere;

        return $this;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getNomsAdActe(): ?string
    {
        return $this->nomsAdActe;
    }

    public function setNomsAdActe(?string $nomsAdActe): self
    {
        $this->nomsAdActe = $nomsAdActe;

        return $this;
    }

    public function getNumActeRevers(): ?string
    {
        return $this->numActeRevers;
    }

    public function setNumActeRevers(?string $numActeRevers): self
    {
        $this->numActeRevers = $numActeRevers;

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

    public function getDateSignatureRev(): ?\DateTimeInterface
    {
        return $this->dateSignatureRev;
    }

    public function setDateSignatureRev(?\DateTimeInterface $dateSignatureRev): self
    {
        $this->dateSignatureRev = $dateSignatureRev;

        return $this;
    }

    public function getConformeYN(): ?bool
    {
        return $this->conforme_Y_N;
    }

    public function setConformeYN(?bool $conforme_Y_N): self
    {
        $this->conforme_Y_N = $conforme_Y_N;

        return $this;
    }

    public function getDateSaisieRevers(): ?\DateTimeInterface
    {
        return $this->dateSaisieRevers;
    }

    public function setDateSaisieRevers(?\DateTimeInterface $dateSaisieRevers): self
    {
        $this->dateSaisieRevers = $dateSaisieRevers;

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
}
