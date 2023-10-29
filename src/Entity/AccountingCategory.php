<?php

namespace App\Entity;

use App\Repository\AccountingCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountingCategoryRepository::class)]
class AccountingCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'accountingCategories')]
    private ?self $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: self::class)]
    private Collection $accountingCategories;

    #[ORM\OneToMany(mappedBy: 'accountingCategory', targetEntity: AccountingEntry::class)]
    private Collection $accountingEntries;

    #[ORM\OneToMany(mappedBy: 'accountingCategory', targetEntity: AccountingPlanned::class, orphanRemoval: true)]
    private Collection $accountingPlanneds;

    public function __construct()
    {
        $this->accountingCategories = new ArrayCollection();
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

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAccountingCategories(): Collection
    {
        return $this->accountingCategories;
    }

    public function addAccountingCategory(self $accountingCategory): static
    {
        if (!$this->accountingCategories->contains($accountingCategory)) {
            $this->accountingCategories->add($accountingCategory);
            $accountingCategory->setParent($this);
        }

        return $this;
    }

    public function removeAccountingCategory(self $accountingCategory): static
    {
        if ($this->accountingCategories->removeElement($accountingCategory)) {
            // set the owning side to null (unless already changed)
            if ($accountingCategory->getParent() === $this) {
                $accountingCategory->setParent(null);
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
            $accountingEntry->setAccountingCategory($this);
        }

        return $this;
    }

    public function removeAccountingEntry(AccountingEntry $accountingEntry): static
    {
        if ($this->accountingEntries->removeElement($accountingEntry)) {
            // set the owning side to null (unless already changed)
            if ($accountingEntry->getAccountingCategory() === $this) {
                $accountingEntry->setAccountingCategory(null);
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
            $accountingPlanned->setAccountingCategory($this);
        }

        return $this;
    }

    public function removeAccountingPlanned(AccountingPlanned $accountingPlanned): static
    {
        if ($this->accountingPlanneds->removeElement($accountingPlanned)) {
            // set the owning side to null (unless already changed)
            if ($accountingPlanned->getAccountingCategory() === $this) {
                $accountingPlanned->setAccountingCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}
