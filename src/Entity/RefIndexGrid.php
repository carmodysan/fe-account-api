<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RefIndexGridRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=RefIndexGridRepository::class)
 */
#[ApiResource]
class RefIndexGrid
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $echelon;

    /**
     * @ORM\Column(type="integer")
     */
    private $monthDuration;

    /**
     * @ORM\Column(type="integer")
     */
    private $increaseIndex;

    /**
     * @ORM\Column(type="integer")
     */
    private $grossIndex;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity=RefRank::class, inversedBy="refIndexGrids")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rank;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEchelon(): ?int
    {
        return $this->echelon;
    }

    public function setEchelon(int $echelon): self
    {
        $this->echelon = $echelon;

        return $this;
    }

    public function getMonthDuration(): ?int
    {
        return $this->monthDuration;
    }

    public function setMonthDuration(int $monthDuration): self
    {
        $this->monthDuration = $monthDuration;

        return $this;
    }

    public function getIncreaseIndex(): ?int
    {
        return $this->increaseIndex;
    }

    public function setIncreaseIndex(int $increaseIndex): self
    {
        $this->increaseIndex = $increaseIndex;

        return $this;
    }

    public function getGrossIndex(): ?int
    {
        return $this->grossIndex;
    }

    public function setGrossIndex(int $grossIndex): self
    {
        $this->grossIndex = $grossIndex;

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

    public function getRank(): ?RefRank
    {
        return $this->rank;
    }

    public function setRank(?RefRank $rank): self
    {
        $this->rank = $rank;

        return $this;
    }
}
