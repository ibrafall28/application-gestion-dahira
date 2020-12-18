<?php

namespace App\Entity;

use App\Repository\TypeEvRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeEvRepository::class)
 */
class TypeEv
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Evennement::class, mappedBy="typeeve")
     */
    private $evennements;

    public function __construct()
    {
        $this->evennements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Evennement[]
     */
    public function getEvennements(): Collection
    {
        return $this->evennements;
    }

    public function addEvennement(Evennement $evennement): self
    {
        if (!$this->evennements->contains($evennement)) {
            $this->evennements[] = $evennement;
            $evennement->setTypeeve($this);
        }

        return $this;
    }

    public function removeEvennement(Evennement $evennement): self
    {
        if ($this->evennements->removeElement($evennement)) {
            // set the owning side to null (unless already changed)
            if ($evennement->getTypeeve() === $this) {
                $evennement->setTypeeve(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->libelle;
    }
}
