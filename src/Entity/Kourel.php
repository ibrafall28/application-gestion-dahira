<?php

namespace App\Entity;

use App\Repository\KourelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KourelRepository::class)
 */
class Kourel
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
     * @ORM\OneToMany(targetEntity=Dadj::class, mappedBy="kourel")
     */
    private $dadjs;

    /**
     * @ORM\OneToMany(targetEntity=Membre::class, mappedBy="kourel")
     */
    private $membres;

    /**
     * @ORM\OneToMany(targetEntity=Repetition::class, mappedBy="kourel")
     */
    private $repetiions;

    public function __construct()
    {
        $this->dadjs = new ArrayCollection();
        $this->membres = new ArrayCollection();
        $this->repetiions = new ArrayCollection();
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
     * @return Collection|Dadj[]
     */
    public function getDadjs(): Collection
    {
        return $this->dadjs;
    }

    public function addDadj(Dadj $dadj): self
    {
        if (!$this->dadjs->contains($dadj)) {
            $this->dadjs[] = $dadj;
            $dadj->setKourel($this);
        }

        return $this;
    }

    public function removeDadj(Dadj $dadj): self
    {
        if ($this->dadjs->removeElement($dadj)) {
            // set the owning side to null (unless already changed)
            if ($dadj->getKourel() === $this) {
                $dadj->setKourel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Membre[]
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membre $membre): self
    {
        if (!$this->membres->contains($membre)) {
            $this->membres[] = $membre;
            $membre->setKourel($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getKourel() === $this) {
                $membre->setKourel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Repetition[]
     */
    public function getRepetiions(): Collection
    {
        return $this->repetiions;
    }

    public function addRepetiion(Repetition $repetiion): self
    {
        if (!$this->repetiions->contains($repetiion)) {
            $this->repetiions[] = $repetiion;
            $repetiion->setKourel($this);
        }

        return $this;
    }

    public function removeRepetiion(Repetition $repetiion): self
    {
        if ($this->repetiions->removeElement($repetiion)) {
            // set the owning side to null (unless already changed)
            if ($repetiion->getKourel() === $this) {
                $repetiion->setKourel(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->libelle;
    }
}
