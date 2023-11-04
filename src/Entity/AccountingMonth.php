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


    #[ORM\OneToMany(mappedBy: 'accountingMonth', targetEntity: AccountingPlanned::class, orphanRemoval: true)]
    private Collection $accountingPlanneds;

    #[Assert\Valid()]
    #[ORM\OneToMany(mappedBy: 'accountingMonthIncome', targetEntity: AccountingEntry::class, cascade: ['persist'])]
    private Collection $incomes;

    #[Assert\Valid()]
    #[ORM\OneToMany(mappedBy: 'accountingMonthOutcome', targetEntity: AccountingEntry::class, cascade: ['persist'])]
    private Collection $outcomes;

    public function __construct()
    {
        $this->accountingPlanneds = new ArrayCollection();
        $this->incomes = new ArrayCollection();
        $this->outcomes = new ArrayCollection();
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

    /**
     * @return Collection<int, AccountingEntry>
     */
    public function getIncomes(): Collection
    {
        return $this->incomes;
    }

    public function addIncome(AccountingEntry $income): static
    {
        if (!$this->incomes->contains($income)) {
            $this->incomes->add($income);
            $income->setAccountingMonthIncome($this);
        }

        return $this;
    }

    public function removeIncome(AccountingEntry $income): static
    {
        if ($this->incomes->removeElement($income)) {
            // set the owning side to null (unless already changed)
            if ($income->getAccountingMonthIncome() === $this) {
                $income->setAccountingMonthIncome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AccountingEntry>
     */
    public function getOutcomes(): Collection
    {
        return $this->outcomes;
    }

    public function addOutcome(AccountingEntry $outcome): static
    {
        if (!$this->outcomes->contains($outcome)) {
            $this->outcomes->add($outcome);
            $outcome->setAccountingMonthOutcome($this);
        }

        return $this;
    }

    public function removeOutcome(AccountingEntry $outcome): static
    {
        if ($this->outcomes->removeElement($outcome)) {
            // set the owning side to null (unless already changed)
            if ($outcome->getAccountingMonthOutcome() === $this) {
                $outcome->setAccountingMonthOutcome(null);
            }
        }

        return $this;
    }
}
