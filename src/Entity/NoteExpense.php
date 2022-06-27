<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteExpenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteExpenseRepository::class)]
#[ApiResource]
class NoteExpense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $noteDate;

    #[ORM\Column(type: 'float')]
    private $amount;

    #[ORM\Column(type: 'date')]
    private $createdAt;

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
}
