<?php

namespace App\Entity;

use App\Repository\AccountingTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountingTagRepository::class)]
class AccountingTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: AccountingEntry::class, inversedBy: 'accountingTags')]
    private Collection $accountingEntries;

    public function __construct()
    {
        $this->accountingEntries = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeAccountingEntry(AccountingEntry $accountingEntry): static
    {
        $this->accountingEntries->removeElement($accountingEntry);

        return $this;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}
