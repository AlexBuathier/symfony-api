<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ApiResource]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 14)]
    private $siret;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: NoteExpense::class)]
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

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

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
            $noteExpense->setCompany($this);
        }

        return $this;
    }

    public function removeNoteExpense(NoteExpense $noteExpense): self
    {
        if ($this->noteExpenses->removeElement($noteExpense)) {
            // set the owning side to null (unless already changed)
            if ($noteExpense->getCompany() === $this) {
                $noteExpense->setCompany(null);
            }
        }

        return $this;
    }
}
