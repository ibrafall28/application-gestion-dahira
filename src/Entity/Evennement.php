<?php

namespace App\Entity;

use App\Repository\EvennementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvennementRepository::class)
 */
class Evennement
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
     * @ORM\OneToMany(targetEntity=Diayante::class, mappedBy="eveneement")
     */
    private $diayantes;

    /**
     * @ORM\ManyToOne(targetEntity=TypeEv::class, inversedBy="evennements")
     */
    private $typeeve;

    /**
     * @ORM\OneToMany(targetEntity=Khassida::class, mappedBy="evennement")
     */
    private $khassidas;

    public function __construct()
    {
        $this->diayantes = new ArrayCollection();
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
     * @return Collection|Diayante[]
     */
    public function getDiayantes(): Collection
    {
        return $this->diayantes;
    }

    public function addDiayante(Diayante $diayante): self
    {
        if (!$this->diayantes->contains($diayante)) {
            $this->diayantes[] = $diayante;
            $diayante->setEveneement($this);
        }

        return $this;
    }

    public function removeDiayante(Diayante $diayante): self
    {
        if ($this->diayantes->removeElement($diayante)) {
            // set the owning side to null (unless already changed)
            if ($diayante->getEveneement() === $this) {
                $diayante->setEveneement(null);
            }
        }

        return $this;
    }

    public function getTypeeve(): ?TypeEv
    {
        return $this->typeeve;
    }

    public function setTypeeve(?TypeEv $typeeve): self
    {
        $this->typeeve = $typeeve;

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
            $khassida->setEvennement($this);
        }

        return $this;
    }

    public function removeKhassida(Khassida $khassida): self
    {
        if ($this->khassidas->removeElement($khassida)) {
            // set the owning side to null (unless already changed)
            if ($khassida->getEvennement() === $this) {
                $khassida->setEvennement(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->nom;
    }
}
