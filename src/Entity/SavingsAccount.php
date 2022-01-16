<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\SavingsAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

/**
 * @ApiResource(collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={"authorId": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"establishment": "ASC"})
 * @ORM\Entity(repositoryClass=SavingsAccountRepository::class)
 */
class SavingsAccount extends AbstractAccount
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    protected $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected $pendingCumulativeInterest;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected $totalCumulativeInterest;

    /**
     * @ORM\OneToMany(targetEntity=SavingsAccountOperation::class, mappedBy="savingsAccount", orphanRemoval=true)
     * @ApiSubresource
     */
    private $savingsAccountOperations;

    /**
     * @ORM\OneToMany(targetEntity=InterestRate::class, mappedBy="savingsAccount", orphanRemoval=true)
     * @ApiSubresource
     */
    private $interestRates;

    public function __construct()
    {
        $this->savingsAccountOperations = new ArrayCollection();
        $this->interestRates = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getPendingCumulativeInterest(): ?string
    {
        return $this->pendingCumulativeInterest;
    }

    public function setPendingCumulativeInterest(string $pendingCumulativeInterest): self
    {
        $this->pendingCumulativeInterest = $pendingCumulativeInterest;

        return $this;
    }

    public function getTotalCumulativeInterest(): ?string
    {
        return $this->totalCumulativeInterest;
    }

    public function setTotalCumulativeInterest(string $totalCumulativeInterest): self
    {
        $this->totalCumulativeInterest = $totalCumulativeInterest;

        return $this;
    }

    /**
     * @return Collection|SavingsAccountOperation[]
     */
    public function getSavingsAccountOperations(): Collection
    {
        return $this->savingsAccountOperations;
    }

    public function addSavingsAccountOperation(SavingsAccountOperation $savingsAccountOperation): self
    {
        if (!$this->savingsAccountOperations->contains($savingsAccountOperation)) {
            $this->savingsAccountOperations[] = $savingsAccountOperation;
            $savingsAccountOperation->setSavingsAccount($this);
        }

        return $this;
    }

    public function removeSavingsAccountOperation(SavingsAccountOperation $savingsAccountOperation): self
    {
        if ($this->savingsAccountOperations->removeElement($savingsAccountOperation)) {
            // set the owning side to null (unless already changed)
            if ($savingsAccountOperation->getSavingsAccount() === $this) {
                $savingsAccountOperation->setSavingsAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InterestRate[]
     */
    public function getInterestRates(): Collection
    {
        return $this->interestRates;
    }

    public function addInterestRate(InterestRate $interestRate): self
    {
        if (!$this->interestRates->contains($interestRate)) {
            $this->interestRates[] = $interestRate;
            $interestRate->setSavingsAccount($this);
        }

        return $this;
    }

    public function removeInterestRate(InterestRate $interestRate): self
    {
        if ($this->interestRates->removeElement($interestRate)) {
            // set the owning side to null (unless already changed)
            if ($interestRate->getSavingsAccount() === $this) {
                $interestRate->setSavingsAccount(null);
            }
        }

        return $this;
    }
}
