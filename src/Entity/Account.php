<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"account:read"}},
 *      denormalizationContext={"groups"={"account:write"}},
 *      collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={"authorId": "exact", "slug": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"bank": "ASC"})
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * 
     * @Groups("account:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"account:read", "account:write"})
     */
    private $bank;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"account:read", "account:write"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"account:read", "account:write"})
     */
    private $authorId;

    /**
     * @ORM\OneToMany(targetEntity=MonthlyAccount::class, mappedBy="account", orphanRemoval=true)
     * @ApiSubresource
     * 
     * @Groups({"account:read", "account:write"})
     */
    private $monthlyAccounts;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * 
     * @Groups({"account:read", "account:write"})
     */
    private $balance;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"account:read", "account:write"})
     */
    private $slug;

    public function __construct()
    {
        $this->monthlyAccounts = new ArrayCollection();
        $this->balance = 0;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(string $bank): self
    {
        $this->bank = $bank;

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

    public function getAuthorId(): ?string
    {
        return $this->authorId;
    }

    public function setAuthorId(string $authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * @return Collection|MonthlyAccount[]
     */
    public function getMonthlyAccounts(): Collection
    {
        return $this->monthlyAccounts;
    }

    public function addMonthlyAccount(MonthlyAccount $monthlyAccount): self
    {
        if (!$this->monthlyAccounts->contains($monthlyAccount)) {
            $this->monthlyAccounts[] = $monthlyAccount;
            $monthlyAccount->setAccount($this);
        }

        return $this;
    }

    public function removeMonthlyAccount(MonthlyAccount $monthlyAccount): self
    {
        if ($this->monthlyAccounts->removeElement($monthlyAccount)) {
            // set the owning side to null (unless already changed)
            if ($monthlyAccount->getAccount() === $this) {
                $monthlyAccount->setAccount(null);
            }
        }

        return $this;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): self
    {
        $this->balance = $balance;

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
