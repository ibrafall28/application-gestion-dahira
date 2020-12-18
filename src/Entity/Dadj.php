<?php

namespace App\Entity;

use App\Repository\DadjRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DadjRepository::class)
 */
class Dadj
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
     * @ORM\OneToMany(targetEntity=Khassida::class, mappedBy="dadji")
     */
    private $khassidas;

    /**
     * @ORM\ManyToOne(targetEntity=Kourel::class, inversedBy="dadjs")
     */
    private $kourel;



    public function __construct()
    {
        $this->khassidas = new ArrayCollection();
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
     * @return Collection|Khassida[]
     */
    public function getKhassidas(): Collection
    {
        return $this->khassidas;
    }

    public function addKhassida(Khassida $khassida): self
    {
        if (!$this->khassidas->contains($khassida)) {
            $this->khassidas[] = $khassida;
            $khassida->setDadji($this);
        }

        return $this;
    }

    public function removeKhassida(Khassida $khassida): self
    {
        if ($this->khassidas->removeElement($khassida)) {
            // set the owning side to null (unless already changed)
            if ($khassida->getDadji() === $this) {
                $khassida->setDadji(null);
            }
        }

        return $this;
    }

    public function getKourel(): ?Kourel
    {
        return $this->kourel;
    }

    public function setKourel(?Kourel $kourel): self
    {
        $this->kourel = $kourel;

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
            $membre->setDadj($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getDadj() === $this) {
                $membre->setDadj(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->nom;
    }
}
