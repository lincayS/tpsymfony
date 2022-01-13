<?php

namespace App\Entity;

use App\Repository\CadeauxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CadeauxRepository::class)
 */
class Cadeaux
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $ageParfait;

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

    public function getAgeParfait(): ?int
    {
        return $this->ageParfait;
    }

    public function setAgeParfait(int $ageParfait): self
    {
        $this->ageParfait = $ageParfait;

        return $this;
    }
}
