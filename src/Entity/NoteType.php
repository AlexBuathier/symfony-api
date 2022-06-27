<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NoteTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NoteTypeRepository::class)]
#[ApiResource (itemOperations: ["GET"], collectionOperations: [])]
class NoteType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("note-expense:read")]
    private $id;

    #[ORM\Column(type: 'string', length: 10)]
    #[Groups("note-expense:read")]
    private $name;

    #[ORM\OneToMany(mappedBy: 'noteType', targetEntity: NoteExpense::class)]
    private $noteExpenses;

    public function __construct()
    {
        $this->noteExpenses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, NoteExpense>
     */
    public function getNoteExpenses(): Collection
    {
        return $this->noteExpenses;
    }

    public function addNoteExpense(NoteExpense $noteExpense): self
    {
        if (!$this->noteExpenses->contains($noteExpense)) {
            $this->noteExpenses[] = $noteExpense;
            $noteExpense->setNoteType($this);
        }

        return $this;
    }

    public function removeNoteExpense(NoteExpense $noteExpense): self
    {
        if ($this->noteExpenses->removeElement($noteExpense)) {
            // set the owning side to null (unless already changed)
            if ($noteExpense->getNoteType() === $this) {
                $noteExpense->setNoteType(null);
            }
        }

        return $this;
    }
}
