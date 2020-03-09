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

    public function __construct()
    {
        $this->reversions = new ArrayCollection();
        $this->invalidites = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
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
}
