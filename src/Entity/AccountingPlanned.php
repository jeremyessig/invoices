<?php

namespace App\Entity;

use App\Repository\AccountingPlannedRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountingPlannedRepository::class)]
class AccountingPlanned
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isIncome = null;

    #[ORM\ManyToOne(inversedBy: 'accountingPlanneds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AccountingMonth $accountingMonth = null;

    #[ORM\ManyToOne(inversedBy: 'accountingPlanneds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AccountingCategory $accountingCategory = null;

    #[ORM\ManyToOne(inversedBy: 'accountingPlanneds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsIncome(): ?bool
    {
        return $this->isIncome;
    }

    public function setIsIncome(bool $isIncome): static
    {
        $this->isIncome = $isIncome;

        return $this;
    }

    public function getAccountingMonth(): ?AccountingMonth
    {
        return $this->accountingMonth;
    }

    public function setAccountingMonth(?AccountingMonth $accountingMonth): static
    {
        $this->accountingMonth = $accountingMonth;

        return $this;
    }

    public function getAccountingCategory(): ?AccountingCategory
    {
        return $this->accountingCategory;
    }

    public function setAccountingCategory(?AccountingCategory $accountingCategory): static
    {
        $this->accountingCategory = $accountingCategory;

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
}
