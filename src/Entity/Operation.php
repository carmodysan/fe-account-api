<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\OperationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

// TODO : mettre en place la suppression et la modification, voir tuto ci-dessous

/**
 * Cette classe est librement inspiré depuis le tuto :
 * https://www.kaherecode.com/tutorial/developper-une-api-rest-avec-symfony-et-api-platform-autorisation
 * Il reste à traiter la moddification et la suppression, voir TODO
 * 
 * @ApiResource(
 *      normalizationContext={"groups"={"operation:read"}},
 *      denormalizationContext={"groups"={"operation:write"}},
 * )
 * @ApiFilter(OrderFilter::class, properties={"dateOp": "ASC"})
 * @ORM\Entity(repositoryClass=OperationRepository::class)
 */
class Operation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * 
     * @Groups({"operation:read", "monthlyaccount:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * 
     * @Groups({"operation:read", "operation:write", "monthlyaccount:read"})
     */
    private $dateOp;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"operation:read", "operation:write", "monthlyaccount:read"})
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"operation:read", "operation:write", "monthlyaccount:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     * 
     * @Groups({"operation:read", "operation:write", "monthlyaccount:read"})
     */
    private $credit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     * 
     * @Groups({"operation:read", "operation:write", "monthlyaccount:read"})
     */
    private $debit;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"operation:read", "operation:write", "monthlyaccount:read"})
     */
    private $checked;

    /**
     * @ORM\ManyToOne(targetEntity=MonthlyAccount::class, inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     * 
     * @Groups({"operation:write"})
     */
    private $monthlyAccount;

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDateOp(): ?\DateTimeInterface
    {
        return $this->dateOp;
    }

    public function setDateOp(\DateTimeInterface $dateOp): self
    {
        $this->dateOp = $dateOp;

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

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function setCredit(?float $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    public function getDebit(): ?float
    {
        return $this->debit;
    }

    public function setDebit(?float $debit): self
    {
        $this->debit = $debit;

        return $this;
    }

    public function getChecked(): ?bool
    {
        return $this->checked;
    }

    public function setChecked(bool $checked): self
    {
        $this->checked = $checked;

        return $this;
    }

    public function getMonthlyAccount(): ?MonthlyAccount
    {
        return $this->monthlyAccount;
    }

    public function setMonthlyAccount(?MonthlyAccount $monthlyAccount): self
    {
        $this->monthlyAccount = $monthlyAccount;

        return $this;
    }
}
