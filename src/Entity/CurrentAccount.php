<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\CurrentAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

/**
 * @ApiResource(
 *      collectionOperations={
 *         "get",
 *         "post"={"security"="is_granted('ROLE_USER')"}
 *     },
 * )
 * @ApiFilter(SearchFilter::class, properties={"authorId": "exact"})
 * @ApiFilter(OrderFilter::class, properties={"establishment": "ASC"})
 * @ORM\Entity(repositoryClass=CurrentAccountRepository::class)
 */
class CurrentAccount extends AbstractAccount
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
    protected $upcomingBalance;

    /**
     * @ORM\OneToMany(targetEntity=MonthlyAccount::class, mappedBy="currentAccount", orphanRemoval=true)
     * @ApiSubresource
     */
    private $monthlyAccounts;

    public function __construct()
    {
        $this->monthlyAccounts = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUpcomingBalance(): ?string
    {
        return $this->upcomingBalance;
    }

    public function setUpcomingBalance(string $upcomingBalance): self
    {
        $this->upcomingBalance = $upcomingBalance;

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
            $monthlyAccount->setCurrentAccount($this);
        }

        return $this;
    }

    public function removeMonthlyAccount(MonthlyAccount $monthlyAccount): self
    {
        if ($this->monthlyAccounts->removeElement($monthlyAccount)) {
            // set the owning side to null (unless already changed)
            if ($monthlyAccount->getCurrentAccount() === $this) {
                $monthlyAccount->setCurrentAccount(null);
            }
        }

        return $this;
    }
}
