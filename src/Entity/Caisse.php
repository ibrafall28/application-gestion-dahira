<?php

namespace App\Entity;

use App\Repository\CaisseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaisseRepository::class)
 */
class Caisse
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
    private $numero;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $solde;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Hadiya::class, mappedBy="caisse")
     */
    private $hadiyas;

    /**
     * @ORM\OneToMany(targetEntity=Diayante::class, mappedBy="caisse")
     */
    private $diayantes;

    public function __construct()
    {
        $this->hadiyas = new ArrayCollection();
        $this->diayantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getSolde(): ?string
    {
        return $this->solde;
    }

    public function setSolde(string $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Hadiya[]
     */
    public function getHadiyas(): Collection
    {
        return $this->hadiyas;
    }

    public function addHadiya(Hadiya $hadiya): self
    {
        if (!$this->hadiyas->contains($hadiya)) {
            $this->hadiyas[] = $hadiya;
            $hadiya->setCaisse($this);
        }

        return $this;
    }

    public function removeHadiya(Hadiya $hadiya): self
    {
        if ($this->hadiyas->removeElement($hadiya)) {
            // set the owning side to null (unless already changed)
            if ($hadiya->getCaisse() === $this) {
                $hadiya->setCaisse(null);
            }
        }

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
            $diayante->setCaisse($this);
        }

        return $this;
    }

    public function removeDiayante(Diayante $diayante): self
    {
        if ($this->diayantes->removeElement($diayante)) {
            // set the owning side to null (unless already changed)
            if ($diayante->getCaisse() === $this) {
                $diayante->setCaisse(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->numero;
    }
}
