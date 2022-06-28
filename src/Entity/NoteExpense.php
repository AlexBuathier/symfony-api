<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteExpenseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: NoteExpenseRepository::class)]
#[ApiResource(
    collectionOperations: ['GET', 'POST'],
    itemOperations: ['GET', 'DELETE', 'PUT'],
    denormalizationContext: ["groups" => ["note-expense:write"],"datetime_format" => "Y-m-d"],
    normalizationContext: ["groups" => ["note-expense:read"], "datetime_format" => "Y-m-d"]
)]
class NoteExpense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["note-expense:read", "note-expense:write"])]
    private $id;

    #[ORM\Column(type: 'date')]
    #[Groups(["note-expense:read", "note-expense:write"])]
    #[Assert\Type('DateTimeInterface' , message: "La date doit être au format YYYY-MM-DD")]
    private $noteDate;

    #[ORM\Column(type: 'float')]
    #[Groups(["note-expense:read", "note-expense:write"])]
    #[Assert\Positive(message: "La valeur doit être positive"),
        Assert\NotNull(message: "La valeur doit être renseignée")]
    private $amount;

    #[ORM\Column(type: 'date')]
    #[Groups(["note-expense:read"])]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: NoteType::class, inversedBy: 'noteExpenses')]
    #[Groups(["note-expense:read", "note-expense:write"])]
    #[Assert\NotNull(message: "L' IRI doit être au format > /api/note-type/{id}")]
    private $noteType;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'noteExpenses')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["note-expense:read", "note-expense:write"])]
    #[Assert\NotNull(message: "L' IRI doit être au format > /api/companies/{id}")]
    private $company;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'noteExpenses')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoteDate(): ?\DateTimeInterface
    {
        return $this->noteDate;
    }

    public function setNoteDate(\DateTimeInterface $noteDate): self
    {
        $this->noteDate = $noteDate;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNoteType(): ?NoteType
    {
        return $this->noteType;
    }

    public function setNoteType(?NoteType $noteType): self
    {
        $this->noteType = $noteType;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
