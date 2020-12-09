<?php

namespace App\Entity;


use App\Repository\FightersRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=FightersRepository::class)
 */
class Fighters
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poids;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $allonge;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $palmares;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="json")
     */
    private $categorie = ["Middleweight"];

    /**
     * @ORM\Column(type="json")
     */
    private $rang = ["1"];

    /**
     * @ORM\Column(type="json")
     */
    private $sexe = ["Homme"];

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(string $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getAllonge(): ?string
    {
        return $this->allonge;
    }

    public function setAllonge(string $allonge): self
    {
        $this->allonge = $allonge;

        return $this;
    }

    public function getPalmares(): ?string
    {
        return $this->palmares;
    }

    public function setPalmares(string $palmares): self
    {
        $this->palmares = $palmares;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCategorie(): ?array
    {
        return $this->categorie;
    }

    public function setCategorie(array $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getRang(): ?array
    {
        return $this->rang;
    }

    public function setRang(array $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getSexe(): ?array
    {
        return $this->sexe;
    }

    public function setSexe(array $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

}
