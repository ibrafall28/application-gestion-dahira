<?php

namespace App\Entity;

use App\Repository\RepetitionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RepetitionRepository::class)
 */
class Repetition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $heurdebut;

    /**
     * @ORM\Column(type="time")
     */
    private $heurfin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Kourel::class, inversedBy="repetiions")
     */
    private $kourel;

    /**
     * @ORM\ManyToOne(targetEntity=TypeRepetition::class, inversedBy="repetitions")
     */
    private $typere;

    /**
     * @ORM\ManyToOne(targetEntity=Lieu::class, inversedBy="repetitions")
     */
    private $lieu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeurdebut(): ?\DateTimeInterface
    {
        return $this->heurdebut;
    }

    public function setHeurdebut(\DateTimeInterface $heurdebut): self
    {
        $this->heurdebut = $heurdebut;

        return $this;
    }

    public function getHeurfin(): ?\DateTimeInterface
    {
        return $this->heurfin;
    }

    public function setHeurfin(\DateTimeInterface $heurfin): self
    {
        $this->heurfin = $heurfin;

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

    public function getKourel(): ?Kourel
    {
        return $this->kourel;
    }

    public function setKourel(?Kourel $kourel): self
    {
        $this->kourel = $kourel;

        return $this;
    }

    public function getTypere(): ?TypeRepetition
    {
        return $this->typere;
    }

    public function setTypere(?TypeRepetition $typere): self
    {
        $this->typere = $typere;

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }
}
