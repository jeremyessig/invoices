<?php

namespace App\Entity;

use App\Repository\AccountingEntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountingEntryRepository::class)]
class AccountingEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isIncome = null;

    #[ORM\ManyToOne(inversedBy: 'accountingEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AccountingMonth $accountingMonth = null;

    #[ORM\ManyToOne(inversedBy: 'accountingEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'accountingEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AccountingCategory $accountingCategory = null;

    #[ORM\ManyToMany(targetEntity: AccountingTag::class, mappedBy: 'accountingEntries')]
    private Collection $accountingTags;

    public function __construct()
    {
        $this->accountingTags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

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

    /**
     * @return Collection<int, AccountingTag>
     */
    public function getAccountingTags(): Collection
    {
        return $this->accountingTags;
    }

    public function addAccountingTag(AccountingTag $accountingTag): static
    {
        if (!$this->accountingTags->contains($accountingTag)) {
            $this->accountingTags->add($accountingTag);
            $accountingTag->addAccountingEntry($this);
        }

        return $this;
    }

    public function removeAccountingTag(AccountingTag $accountingTag): static
    {
        if ($this->accountingTags->removeElement($accountingTag)) {
            $accountingTag->removeAccountingEntry($this);
        }

        return $this;
    }
}
