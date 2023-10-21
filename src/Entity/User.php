<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: AccountingMonth::class, orphanRemoval: true)]
    private Collection $accountingMonths;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: AccountingEntry::class, orphanRemoval: true)]
    private Collection $accountingEntries;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: AccountingPlanned::class, orphanRemoval: true)]
    private Collection $accountingPlanneds;

    public function __construct()
    {
        $this->accountingMonths = new ArrayCollection();
        $this->accountingEntries = new ArrayCollection();
        $this->accountingPlanneds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, AccountingMonth>
     */
    public function getAccountingMonths(): Collection
    {
        return $this->accountingMonths;
    }

    public function addAccountingMonth(AccountingMonth $accountingMonth): static
    {
        if (!$this->accountingMonths->contains($accountingMonth)) {
            $this->accountingMonths->add($accountingMonth);
            $accountingMonth->setOwner($this);
        }

        return $this;
    }

    public function removeAccountingMonth(AccountingMonth $accountingMonth): static
    {
        if ($this->accountingMonths->removeElement($accountingMonth)) {
            // set the owning side to null (unless already changed)
            if ($accountingMonth->getOwner() === $this) {
                $accountingMonth->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AccountingEntry>
     */
    public function getAccountingEntries(): Collection
    {
        return $this->accountingEntries;
    }

    public function addAccountingEntry(AccountingEntry $accountingEntry): static
    {
        if (!$this->accountingEntries->contains($accountingEntry)) {
            $this->accountingEntries->add($accountingEntry);
            $accountingEntry->setOwner($this);
        }

        return $this;
    }

    public function removeAccountingEntry(AccountingEntry $accountingEntry): static
    {
        if ($this->accountingEntries->removeElement($accountingEntry)) {
            // set the owning side to null (unless already changed)
            if ($accountingEntry->getOwner() === $this) {
                $accountingEntry->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AccountingPlanned>
     */
    public function getAccountingPlanneds(): Collection
    {
        return $this->accountingPlanneds;
    }

    public function addAccountingPlanned(AccountingPlanned $accountingPlanned): static
    {
        if (!$this->accountingPlanneds->contains($accountingPlanned)) {
            $this->accountingPlanneds->add($accountingPlanned);
            $accountingPlanned->setOwner($this);
        }

        return $this;
    }

    public function removeAccountingPlanned(AccountingPlanned $accountingPlanned): static
    {
        if ($this->accountingPlanneds->removeElement($accountingPlanned)) {
            // set the owning side to null (unless already changed)
            if ($accountingPlanned->getOwner() === $this) {
                $accountingPlanned->setOwner(null);
            }
        }

        return $this;
    }
}
