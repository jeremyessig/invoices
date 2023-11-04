<?php

namespace App\Entity;

use App\Repository\AccountingEntryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AccountingEntryRepository::class)]
class AccountingEntry
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotNull()]
    #[ORM\Column]
    private ?\DateTime $date = null;

    #[Assert\NotBlank]
    #[Assert\PositiveOrZero()]
    #[ORM\Column]
    private ?int $amount = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'accountingEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'accountingEntries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AccountingCategory $accountingCategory = null;

    #[ORM\ManyToMany(targetEntity: AccountingTag::class, mappedBy: 'accountingEntries')]
    private Collection $accountingTags;

    #[ORM\ManyToOne(inversedBy: 'incomes')]
    private ?AccountingMonth $accountingMonthIncome = null;

    #[ORM\ManyToOne(inversedBy: 'outcomes')]
    private ?AccountingMonth $accountingMonthOutcome = null;

    public function __construct()
    {
        $this->accountingTags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(?\DateTime $date): static
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

    public function __toString()
    {
        return $this->getLabel();
    }

    public function getAccountingMonthIncome(): ?AccountingMonth
    {
        return $this->accountingMonthIncome;
    }

    public function setAccountingMonthIncome(?AccountingMonth $accountingMonthIncome): static
    {
        $this->accountingMonthIncome = $accountingMonthIncome;

        return $this;
    }

    public function getAccountingMonthOutcome(): ?AccountingMonth
    {
        return $this->accountingMonthOutcome;
    }

    public function setAccountingMonthOutcome(?AccountingMonth $accountingMonthOutcome): static
    {
        $this->accountingMonthOutcome = $accountingMonthOutcome;

        return $this;
    }
}
