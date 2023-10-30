<?php

namespace App\Entity;

use App\Repository\AccountingMonthRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AccountingMonthRepository::class)]
class AccountingMonth
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $endAt = null;

    #[ORM\ManyToOne(inversedBy: 'accountingMonths')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AccountingYear $accountingYear = null;

    #[ORM\ManyToOne(inversedBy: 'accountingMonths')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[assert\Valid()]
    #[ORM\OneToMany(mappedBy: 'accountingMonth', targetEntity: AccountingEntry::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $accountingEntries;

    #[ORM\OneToMany(mappedBy: 'accountingMonth', targetEntity: AccountingPlanned::class, orphanRemoval: true)]
    private Collection $accountingPlanneds;

    public function __construct()
    {
        $this->accountingEntries = new ArrayCollection();
        $this->accountingPlanneds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAccountingYear(): ?AccountingYear
    {
        return $this->accountingYear;
    }

    public function setAccountingYear(?AccountingYear $accountingYear): static
    {
        $this->accountingYear = $accountingYear;

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
            $accountingEntry->setAccountingMonth($this);
        }

        return $this;
    }

    public function removeAccountingEntry(AccountingEntry $accountingEntry): static
    {
        if ($this->accountingEntries->removeElement($accountingEntry)) {
            // set the owning side to null (unless already changed)
            if ($accountingEntry->getAccountingMonth() === $this) {
                $accountingEntry->setAccountingMonth(null);
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
            $accountingPlanned->setAccountingMonth($this);
        }

        return $this;
    }

    public function removeAccountingPlanned(AccountingPlanned $accountingPlanned): static
    {
        if ($this->accountingPlanneds->removeElement($accountingPlanned)) {
            // set the owning side to null (unless already changed)
            if ($accountingPlanned->getAccountingMonth() === $this) {
                $accountingPlanned->setAccountingMonth(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}
