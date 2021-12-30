<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CurrentAccountOperationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CurrentAccountOperationRepository::class)
 */
class CurrentAccountOperation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $credit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $debit;

    /**
     * @ORM\Column(type="boolean")
     */
    private $checked;

    /**
     * @ORM\ManyToOne(targetEntity=MonthlyAccount::class, inversedBy="currentAccountOperations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $monthlyAccount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fromPeriodic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOp(): ?\DateTimeInterface
    {
        return $this->dateOp;
    }

    public function setDateOp(\DateTimeInterface $dateOp): self
    {
        $this->dateOp = $dateOp;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCredit(): ?string
    {
        return $this->credit;
    }

    public function setCredit(string $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getDebit(): ?string
    {
        return $this->debit;
    }

    public function setDebit(string $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function getMonthlyAccount(): ?MonthlyAccount
    {
        return $this->monthlyAccount;
    }

    public function setMonthlyAccount(?MonthlyAccount $monthlyAccount): self
    {
        $this->monthlyAccount = $monthlyAccount;

        return $this;
    }

    public function getFromPeriodic(): ?bool
    {
        return $this->fromPeriodic;
    }

    public function setFromPeriodic(bool $fromPeriodic): self
    {
        $this->fromPeriodic = $fromPeriodic;

        return $this;
    }
}
