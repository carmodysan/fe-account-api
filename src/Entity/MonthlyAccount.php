<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\MonthlyAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

// TODO : mettre en place la suppression et la modification, voir tuto ci-dessous

/**
 * Cette classe est librement inspiré depuis le tuto :
 * https://www.kaherecode.com/tutorial/developper-une-api-rest-avec-symfony-et-api-platform-autorisation
 * Il reste à traiter la moddification et la suppression, voir TODO
 * 
 * @ApiResource(
 *      normalizationContext={"groups"={"monthlyaccount:read"}},
 *      denormalizationContext={"groups"={"monthlyaccount:write"}},
 *      collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 * )
 * @ORM\Entity(repositoryClass=MonthlyAccountRepository::class)
 */
class MonthlyAccount
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * 
     * @Groups("monthlyaccount:read", "user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"monthlyaccount:read", "monthlyaccount:write", "user:read"})
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"monthlyaccount:read", "monthlyaccount:write", "user:read"})
     */
    private $month;

    /**
     * @ORM\OneToMany(targetEntity=Operation::class, mappedBy="monthlyAccount", orphanRemoval=true)
     * @ApiSubresource
     * 
     * @Groups("monthlyaccount:read")
     */
    private $operations;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="monthlyAccounts")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups("monthlyaccount:read")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups("article:read")
     */
    private $slug;

    public function __construct()
    {
        $this->operations = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month): self
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @return Collection|Operation[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
            $operation->setMonthlyAccount($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getMonthlyAccount() === $this) {
                $operation->setMonthlyAccount(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
