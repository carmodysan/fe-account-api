<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\InterestRateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=InterestRateRepository::class)
 */
#[ApiResource]
#[ApiFilter(OrderFilter::class, properties: ['startDate' => 'DESC'])]
class InterestRate
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $rate;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity=SavingsAccount::class, inversedBy="interestRates")
     * @ORM\JoinColumn(nullable=false)
     */
    private $savingsAccount;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

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
