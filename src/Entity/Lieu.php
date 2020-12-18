<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuRepository::class)
 */
class Lieu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Repetition::class, mappedBy="lieu")
     */
    private $repetitions;

    public function __construct()
    {
        $this->repetitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Repetition[]
     */
    public function getRepetitions(): Collection
    {
        return $this->repetitions;
    }

    public function addRepetition(Repetition $repetition): self
    {
        if (!$this->repetitions->contains($repetition)) {
            $this->repetitions[] = $repetition;
            $repetition->setLieu($this);
        }

        return $this;
    }

    public function removeRepetition(Repetition $repetition): self
    {
        if ($this->repetitions->removeElement($repetition)) {
            // set the owning side to null (unless already changed)
            if ($repetition->getLieu() === $this) {
                $repetition->setLieu(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->nom;
    }
}
