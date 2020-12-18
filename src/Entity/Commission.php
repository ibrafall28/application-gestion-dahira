<?php

namespace App\Entity;

use App\Repository\CommissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommissionRepository::class)
 */
class Commission
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
     * @ORM\OneToMany(targetEntity=Depense::class, mappedBy="commission")
     */
    private $depanses;

    /**
     * @ORM\OneToMany(targetEntity=Materiel::class, mappedBy="commission")
     */
    private $materiels;



    /**
     * @ORM\OneToMany(targetEntity=Membre::class, mappedBy="commission")
     */
    private $membres;

    public function __construct()
    {
        $this->depanses = new ArrayCollection();
        $this->materiels = new ArrayCollection();
        $this->membres = new ArrayCollection();
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
     * @return Collection|Depense[]
     */
    public function getDepanses(): Collection
    {
        return $this->depanses;
    }

    public function addDepanse(Depense $depanse): self
    {
        if (!$this->depanses->contains($depanse)) {
            $this->depanses[] = $depanse;
            $depanse->setCommission($this);
        }

        return $this;
    }

    public function removeDepanse(Depense $depanse): self
    {
        if ($this->depanses->removeElement($depanse)) {
            // set the owning side to null (unless already changed)
            if ($depanse->getCommission() === $this) {
                $depanse->setCommission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setCommission($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->removeElement($materiel)) {
            // set the owning side to null (unless already changed)
            if ($materiel->getCommission() === $this) {
                $materiel->setCommission(null);
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
            $membre->setCommission($this);
        }

        return $this;
    }

    public function removeMembre(Membre $membre): self
    {
        if ($this->membres->removeElement($membre)) {
            // set the owning side to null (unless already changed)
            if ($membre->getCommission() === $this) {
                $membre->setCommission(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return$this->libelle;
    }

}
