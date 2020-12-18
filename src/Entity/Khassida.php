<?php

namespace App\Entity;

use App\Repository\KhassidaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KhassidaRepository::class)
 */
class Khassida
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
     * @ORM\ManyToOne(targetEntity=Evennement::class, inversedBy="khassidas")
     */
    private $evennement;

    /**
     * @ORM\ManyToOne(targetEntity=Dadj::class, inversedBy="khassidas")
     */
    private $dadji;

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

    public function getEvennement(): ?Evennement
    {
        return $this->evennement;
    }

    public function setEvennement(?Evennement $evennement): self
    {
        $this->evennement = $evennement;

        return $this;
    }

    public function getDadji(): ?Dadj
    {
        return $this->dadji;
    }

    public function setDadji(?Dadj $dadji): self
    {
        $this->dadji = $dadji;

        return $this;
    }
}
