<?php

namespace App\Entity;

use App\Repository\AccountingYearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountingYearRepository::class)]
class AccountingYear
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $endAt = null;

    #[ORM\OneToMany(mappedBy: 'accountingYear', targetEntity: AccountingMonth::class, orphanRemoval: true)]
    private Collection $accountingMonths;

    #[ORM\ManyToOne(inversedBy: 'accountingYears')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    public function __construct()
    {
        $this->accountingMonths = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): static
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeImmutable $endAt): static
    {
        $this->endAt = $endAt;

        return $this;
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
            $accountingMonth->setAccountingYear($this);
        }

        return $this;
    }

    public function removeAccountingMonth(AccountingMonth $accountingMonth): static
    {
        if ($this->accountingMonths->removeElement($accountingMonth)) {
            // set the owning side to null (unless already changed)
            if ($accountingMonth->getAccountingYear() === $this) {
                $accountingMonth->setAccountingYear(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}
