<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SavingsAccountOperationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=SavingsAccountOperationRepository::class)
 */
#[ApiResource]
class SavingsAccountOperation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOp;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $credit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $debit;

    /**
     * @ORM\ManyToOne(targetEntity=SavingsAccount::class, inversedBy="savingsAccountOperations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $savingsAccount;

    public function getId(): Uuid
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

    public function setDebit(?string $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getSavingsAccount(): ?SavingsAccount
    {
        return $this->savingsAccount;
    }

    public function setSavingsAccount(?SavingsAccount $savingsAccount): self
    {
        $this->savingsAccount = $savingsAccount;

        return $this;
    }
}
