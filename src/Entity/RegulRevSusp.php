<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegulRevSuspRepository")
 * @ORM\HasLifecycleCallbacks
 *
 * L'acte d'une pension de réversion pour un agent doit être unique
 * @UniqueEntity(
 *      fields = {"numActeRevers", "nomsAdActe"},
 *      message = "Cet acte de réversion a déjà été enregistré."
 * )
 */
class RegulRevSusp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\Regex(
     *      pattern="/(^[A-Z][0-9]{6}$)|(^[0-9]{5,6}[A-Z]$)/",
     *      message="Le matricule entré n'est pas un matricule valide.")
     */
    private $matricul;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="regulRevSusps")
     */
    private $agentSaisie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomsAyantDroit;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $qualiteAyantDroit;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaisDerOrph;

    /**
     * @ORM\Column(type="string", length=7, nullable=true)
     * @Assert\Regex(
     *      pattern="/(^[A-Z][0-9]{6}$)|(^[0-9]{5,6}[A-Z]$)/",
     *      message="Le matricule entré n'est pas un matricule valide.")
     */
    private $matriculeAuteur;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeces;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=3, minMessage="Le noms de l'ayant droit doit faire au moins {{ limit }} caractères .")
     */
    private $nomsAdActe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min="4",
     *  minMessage="Vous devez entrer le numéro de l'acte attribuant la pension de réversion.")
     */
    private $numActeRevers;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateRegul;

    /**
     * @ORM\Column(type="integer")
     */
    private $aAffect;

    /**
     * @ORM\Column(type="integer")
     */
    private $cc;

    /**
     * @ORM\Column(type="integer")
     */
    private $resultat;

    /**
     * CallBack appelé à chaque fois que l'on veut enregistrer un acte de naissance pour
     * calculer automatiquement la date de régularisation, le résultat et l'agent de saisie.     *.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function prePersist()
    {
        if (!empty($this->dateRegul)) {
            $this->dateRegul = new \DateTime();
        }
    }

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $regulariser_y_n;

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

    public function getAgentSaisie(): ?User
    {
        return $this->agentSaisie;
    }

    public function setAgentSaisie(?User $agentSaisie): self
    {
        $this->agentSaisie = $agentSaisie;

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

    public function getMatriculeAuteur(): ?string
    {
        return $this->matriculeAuteur;
    }

    public function setMatriculeAuteur(?string $matriculeAuteur): self
    {
        $this->matriculeAuteur = $matriculeAuteur;

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

    public function getDateRegul(): ?\DateTimeInterface
    {
        return $this->dateRegul;
    }

    public function setDateRegul(?\DateTimeInterface $dateRegul): self
    {
        $this->dateRegul = $dateRegul;

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
}
