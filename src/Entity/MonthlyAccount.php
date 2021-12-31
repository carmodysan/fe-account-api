<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\MonthlyAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
 * @ApiFilter(SearchFilter::class, properties={"state": "exact"})
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
     * @Groups("monthlyaccount:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"monthlyaccount:read", "monthlyaccount:write"})
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     * 
     * @Groups({"monthlyaccount:read", "monthlyaccount:write"})
     */
    private $month;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice({"open", "close", "current"})
     * 
     * @Groups({"monthlyaccount:read", "monthlyaccount:write"})
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity=CurrentAccount::class, inversedBy="monthlyAccounts")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"monthlyaccount:read", "monthlyaccount:write"})
     */
    private $currentAccount;

    /**
     * @ORM\OneToMany(targetEntity=CurrentAccountOperation::class, mappedBy="monthlyAccount", orphanRemoval=true)
     * @ApiSubresource
     * 
     * @Groups({"monthlyaccount:read", "monthlyaccount:write"})
     */
    private $currentAccountOperations;

    public function __construct()
    {
        $this->currentAccountOperations = new ArrayCollection();
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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getCurrentAccount(): ?CurrentAccount
    {
        return $this->currentAccount;
    }

    public function setCurrentAccount(?CurrentAccount $currentAccount): self
    {
        $this->currentAccount = $currentAccount;

        return $this;
    }

    /**
     * @return Collection|CurrentAccountOperation[]
     */
    public function getCurrentAccountOperations(): Collection
    {
        return $this->currentAccountOperations;
    }

    public function addCurrentAccountOperation(CurrentAccountOperation $currentAccountOperation): self
    {
        if (!$this->currentAccountOperations->contains($currentAccountOperation)) {
            $this->currentAccountOperations[] = $currentAccountOperation;
            $currentAccountOperation->setMonthlyAccount($this);
        }

        return $this;
    }

    public function removeCurrentAccountOperation(CurrentAccountOperation $currentAccountOperation): self
    {
        if ($this->currentAccountOperations->removeElement($currentAccountOperation)) {
            // set the owning side to null (unless already changed)
            if ($currentAccountOperation->getMonthlyAccount() === $this) {
                $currentAccountOperation->setMonthlyAccount(null);
            }
        }

        return $this;
    }
}
