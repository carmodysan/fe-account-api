<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RefRankRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=RefRankRepository::class)
 */
#[ApiResource]
class RefRank
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
    private $level;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $labelLong;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $labelShort;

    /**
     * @ORM\OneToMany(targetEntity=RefIndexGrid::class, mappedBy="rank")
     */
    private $refIndexGrids;

    public function __construct()
    {
        $this->refIndexGrids = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getLabelLong(): ?string
    {
        return $this->labelLong;
    }

    public function setLabelLong(string $labelLong): self
    {
        $this->labelLong = $labelLong;

        return $this;
    }

    public function getLabelShort(): ?string
    {
        return $this->labelShort;
    }

    public function setLabelShort(string $labelShort): self
    {
        $this->labelShort = $labelShort;

        return $this;
    }

    /**
     * @return Collection|RefIndexGrid[]
     */
    public function getRefIndexGrids(): Collection
    {
        return $this->refIndexGrids;
    }

    public function addRefIndexGrid(RefIndexGrid $refIndexGrid): self
    {
        if (!$this->refIndexGrids->contains($refIndexGrid)) {
            $this->refIndexGrids[] = $refIndexGrid;
            $refIndexGrid->setRank($this);
        }

        return $this;
    }

    public function removeRefIndexGrid(RefIndexGrid $refIndexGrid): self
    {
        if ($this->refIndexGrids->removeElement($refIndexGrid)) {
            // set the owning side to null (unless already changed)
            if ($refIndexGrid->getRank() === $this) {
                $refIndexGrid->setRank(null);
            }
        }

        return $this;
    }
}
