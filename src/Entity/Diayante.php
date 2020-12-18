<?php

namespace App\Entity;

use App\Repository\DiayanteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiayanteRepository::class)
 */
class Diayante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="diayantes")
     */
    private $membre;


    /**
     * @ORM\ManyToOne(targetEntity=Caisse::class, inversedBy="diayantes")
     */
    private $caisse;

    /**
     * @ORM\ManyToOne(targetEntity=Evennement::class, inversedBy="diayantes")
     */
    private $eveneement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

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

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }


    public function getCaisse(): ?Caisse
    {
        return $this->caisse;
    }

    public function setCaisse(?Caisse $caisse): self
    {
        $this->caisse = $caisse;

        return $this;
    }

    public function getEveneement(): ?Evennement
    {
        return $this->eveneement;
    }

    public function setEveneement(?Evennement $eveneement): self
    {
        $this->eveneement = $eveneement;

        return $this;
    }
}
