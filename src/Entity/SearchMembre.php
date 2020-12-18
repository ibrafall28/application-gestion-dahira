<?php


namespace App\Entity;


class SearchMembre
{
    private $matricule;
    private $kourel;


    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

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

}
