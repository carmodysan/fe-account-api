<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\PeriodicOperationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

// TODO : mettre en place la suppression et la modification, voir tuto ci-dessous

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"periodicOperation:read"}},
 *      denormalizationContext={"groups"={"periodicOperation:write"}},
 * )
 * @ApiFilter(SearchFilter::class, properties={"authorId": "exact"})
 * @ORM\Entity(repositoryClass=PeriodicOperationRepository::class)
 */
class PeriodicOperation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * 
     * @Groups("periodicOperation:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"periodicOperation:read", "periodicOperation:write"})
     */
    private $dayOfMonth;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"periodicOperation:read", "periodicOperation:write"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"periodicOperation:read", "periodicOperation:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     * 
     * @Groups({"periodicOperation:read", "periodicOperation:write"})
     */
    private $credit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     * 
     * @Groups({"periodicOperation:read", "periodicOperation:write"})
     */
    private $debit;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"periodicOperation:read", "periodicOperation:write"})
     */
    private $authorId;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDayOfMonth(): ?int
    {
        return $this->dayOfMonth;
    }

    public function setDayOfMonth(int $dayOfMonth): self
    {
        $this->dayOfMonth = $dayOfMonth;

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

    public function setCredit(?string $credit): self
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

    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    public function setAuthorId(?string $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }
}
