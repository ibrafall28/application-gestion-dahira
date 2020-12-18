<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 */
class Membre
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity=Commission::class, inversedBy="membres")
     */
    private $commission;

    /**
     * @ORM\OneToMany(targetEntity=Hadiya::class, mappedBy="membre")
     */
    private $hadiyas;


    /**
     * @ORM\OneToMany(targetEntity=Diayante::class, mappedBy="membre")
     */
    private $diayantes;

    /**
     * @ORM\ManyToOne(targetEntity=Kourel::class, inversedBy="membres")
     */
    private $kourel;

    /**
     * @ORM\Column(type="smallint")
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $sexe;








    public function __construct()
    {
        $this->hadiyas = new ArrayCollection();
        $this->diayantes = new ArrayCollection();
        $this->comptes = new ArrayCollection();
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCommission(): ?Commission
    {
        return $this->commission;
    }

    public function setCommission(?Commission $commission): self
    {
        $this->commission = $commission;

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
     * @return Collection|hadiya[]
     */
    public function getHadiyas(): Collection
    {
        return $this->hadiyas;
    }

    public function addHadiya(hadiya $hadiya): self
    {
        if (!$this->hadiyas->contains($hadiya)) {
            $this->hadiyas[] = $hadiya;
            $hadiya->setMembre($this);
        }

        return $this;
    }

    public function removeHadiya(hadiya $hadiya): self
    {
        if ($this->hadiyas->removeElement($hadiya)) {
            // set the owning side to null (unless already changed)
            if ($hadiya->getMembre() === $this) {
                $hadiya->setMembre(null);
            }
        }

        return $this;
    }




    /**
     * @return Collection|diayante[]
     */
    public function getDiayante(): Collection
    {
        return $this->diayante;
    }

    public function addDiayante(diayante $diayante): self
    {
        if (!$this->diayante->contains($diayante)) {
            $this->diayante[] = $diayante;
            $diayante->setMembre($this);
        }

        return $this;
    }

    public function removeDiayante(diayante $diayante): self
    {
        if ($this->diayante->removeElement($diayante)) {
            // set the owning side to null (unless already changed)
            if ($diayante->getMembre() === $this) {
                $diayante->setMembre(null);
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

    public function getDadj(): ?Dadj
    {
        return $this->dadj;
    }

    public function setDadj(?Dadj $dadj): self
    {
        $this->dadj = $dadj;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function __toString()
    {
        return$this->nom;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }





}
