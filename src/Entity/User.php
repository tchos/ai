<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 * L'email doit être unique chez chaque user
 * @UniqueEntity(
 *      fields = {"email"},
 *      message = "Un autre utilisateur s'est déjà inscrit avec cette adresse email, merci de la modifier."
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message = "{{ value }} n'est pas une adresse email valide !")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hash;

    /**
     *@Assert\EqualTo(propertyPath="hash", message="Les mots de passe entrés ne correspondent pas !")
     */
    public $passwordConfirm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Equipe", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reversion", mappedBy="agentSaisie")
     */
    private $reversions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Invalidite", mappedBy="agentSaisie")
     */
    private $invalidites;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Role", mappedBy="users")
     */
    private $userRoles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegulReversion", mappedBy="agentSaisie")
     */
    private $regulReversions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegulInvalidite", mappedBy="agentSaisie")
     */
    private $regulInvalidites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegulRevSusp", mappedBy="agentSaisie")
     */
    private $regulRevSusps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegulRevClo", mappedBy="agentSaisie")
     */
    private $regulRevClos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegulInvSusp", mappedBy="agentSaisie")
     */
    private $regulInvSusps;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RegulInvClo", mappedBy="agentSaisie")
     */
    private $regulInvClos;

    public function __construct()
    {
        $this->reversions = new ArrayCollection();
        $this->invalidites = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
        $this->regulReversions = new ArrayCollection();
        $this->regulInvalidites = new ArrayCollection();
        $this->regulRevSusps = new ArrayCollection();
        $this->regulRevClos = new ArrayCollection();
        $this->regulInvSusps = new ArrayCollection();
        $this->regulInvClos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * @return Collection|Reversion[]
     */
    public function getReversions(): Collection
    {
        return $this->reversions;
    }

    public function addReversion(Reversion $reversion): self
    {
        if (!$this->reversions->contains($reversion)) {
            $this->reversions[] = $reversion;
            $reversion->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeReversion(Reversion $reversion): self
    {
        if ($this->reversions->contains($reversion)) {
            $this->reversions->removeElement($reversion);
            // set the owning side to null (unless already changed)
            if ($reversion->getAgentSaisie() === $this) {
                $reversion->setAgentSaisie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Invalidite[]
     */
    public function getInvalidites(): Collection
    {
        return $this->invalidites;
    }

    public function addInvalidite(Invalidite $invalidite): self
    {
        if (!$this->invalidites->contains($invalidite)) {
            $this->invalidites[] = $invalidite;
            $invalidite->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeInvalidite(Invalidite $invalidite): self
    {
        if ($this->invalidites->contains($invalidite)) {
            $this->invalidites->removeElement($invalidite);
            // set the owning side to null (unless already changed)
            if ($invalidite->getAgentSaisie() === $this) {
                $invalidite->setAgentSaisie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getUserRoles(): Collection
    {
        return $this->userRoles;
    }

    public function addUserRole(Role $userRole): self
    {
        if (!$this->userRoles->contains($userRole)) {
            $this->userRoles[] = $userRole;
            $userRole->addUser($this);
        }

        return $this;
    }

    public function removeUserRole(Role $userRole): self
    {
        if ($this->userRoles->contains($userRole)) {
            $this->userRoles->removeElement($userRole);
            $userRole->removeUser($this);
        }

        return $this;
    }

    // Les fonction à implémenter pour l'interface UserInterface

    public function getRoles()
    {
        $roles = $this->userRoles->map(function ($role) {
            return $role->getTitle();
        })->toArray();

        $roles[] = 'ROLE_USER';

        return $roles;
    }

    public function getPassword()
    {
        return $this->hash;
    }

    public function getSalt()
    {
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Collection|RegulReversion[]
     */
    public function getRegulReversions(): Collection
    {
        return $this->regulReversions;
    }

    public function addRegulReversion(RegulReversion $regulReversion): self
    {
        if (!$this->regulReversions->contains($regulReversion)) {
            $this->regulReversions[] = $regulReversion;
            $regulReversion->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeRegulReversion(RegulReversion $regulReversion): self
    {
        if ($this->regulReversions->contains($regulReversion)) {
            $this->regulReversions->removeElement($regulReversion);
            // set the owning side to null (unless already changed)
            if ($regulReversion->getAgentSaisie() === $this) {
                $regulReversion->setAgentSaisie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RegulInvalidite[]
     */
    public function getRegulInvalidites(): Collection
    {
        return $this->regulInvalidites;
    }

    public function addRegulInvalidite(RegulInvalidite $regulInvalidite): self
    {
        if (!$this->regulInvalidites->contains($regulInvalidite)) {
            $this->regulInvalidites[] = $regulInvalidite;
            $regulInvalidite->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeRegulInvalidite(RegulInvalidite $regulInvalidite): self
    {
        if ($this->regulInvalidites->contains($regulInvalidite)) {
            $this->regulInvalidites->removeElement($regulInvalidite);
            // set the owning side to null (unless already changed)
            if ($regulInvalidite->getAgentSaisie() === $this) {
                $regulInvalidite->setAgentSaisie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RegulRevSusp[]
     */
    public function getRegulRevSusps(): Collection
    {
        return $this->regulRevSusps;
    }

    public function addRegulRevSusp(RegulRevSusp $regulRevSusp): self
    {
        if (!$this->regulRevSusps->contains($regulRevSusp)) {
            $this->regulRevSusps[] = $regulRevSusp;
            $regulRevSusp->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeRegulRevSusp(RegulRevSusp $regulRevSusp): self
    {
        if ($this->regulRevSusps->contains($regulRevSusp)) {
            $this->regulRevSusps->removeElement($regulRevSusp);
            // set the owning side to null (unless already changed)
            if ($regulRevSusp->getAgentSaisie() === $this) {
                $regulRevSusp->setAgentSaisie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RegulRevClo[]
     */
    public function getRegulRevClos(): Collection
    {
        return $this->regulRevClos;
    }

    public function addRegulRevClo(RegulRevClo $regulRevClo): self
    {
        if (!$this->regulRevClos->contains($regulRevClo)) {
            $this->regulRevClos[] = $regulRevClo;
            $regulRevClo->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeRegulRevClo(RegulRevClo $regulRevClo): self
    {
        if ($this->regulRevClos->contains($regulRevClo)) {
            $this->regulRevClos->removeElement($regulRevClo);
            // set the owning side to null (unless already changed)
            if ($regulRevClo->getAgentSaisie() === $this) {
                $regulRevClo->setAgentSaisie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RegulInvSusp[]
     */
    public function getRegulInvSusps(): Collection
    {
        return $this->regulInvSusps;
    }

    public function addRegulInvSusp(RegulInvSusp $regulInvSusp): self
    {
        if (!$this->regulInvSusps->contains($regulInvSusp)) {
            $this->regulInvSusps[] = $regulInvSusp;
            $regulInvSusp->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeRegulInvSusp(RegulInvSusp $regulInvSusp): self
    {
        if ($this->regulInvSusps->contains($regulInvSusp)) {
            $this->regulInvSusps->removeElement($regulInvSusp);
            // set the owning side to null (unless already changed)
            if ($regulInvSusp->getAgentSaisie() === $this) {
                $regulInvSusp->setAgentSaisie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RegulInvClo[]
     */
    public function getRegulInvClos(): Collection
    {
        return $this->regulInvClos;
    }

    public function addRegulInvClo(RegulInvClo $regulInvClo): self
    {
        if (!$this->regulInvClos->contains($regulInvClo)) {
            $this->regulInvClos[] = $regulInvClo;
            $regulInvClo->setAgentSaisie($this);
        }

        return $this;
    }

    public function removeRegulInvClo(RegulInvClo $regulInvClo): self
    {
        if ($this->regulInvClos->contains($regulInvClo)) {
            $this->regulInvClos->removeElement($regulInvClo);
            // set the owning side to null (unless already changed)
            if ($regulInvClo->getAgentSaisie() === $this) {
                $regulInvClo->setAgentSaisie(null);
            }
        }

        return $this;
    }
}
