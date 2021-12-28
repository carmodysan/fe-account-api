<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\SavingsAccountRepository;
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
    protected $interestRate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected $pendingCumulativeInterest;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected $totalCumulativeInterest;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getInterestRate(): ?string
    {
        return $this->interestRate;
    }

    public function setInterestRate(string $interestRate): self
    {
        $this->interestRate = $interestRate;

        return $this;
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
}
