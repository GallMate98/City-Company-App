<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ORM\Table(name: "companies")]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NumeFirme = null;

    #[ORM\Column(length: 350)]
    private ?string $Adresa = null;

    #[ORM\Column(length: 255)]
    private ?string $Categorie = null;

    #[ORM\Column(length: 1000000)]
    private ?string $Logo = null;

    #[ORM\Column(nullable: true)]
    private ?int $Vizualizare = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getNumeFirme(): ?string {
        return $this->NumeFirme;
    }

    public function setNumeFirme(string $NumeFirme): static {
        $this->NumeFirme = $NumeFirme;

        return $this;
    }

    public function getAdresa(): ?string {
        return $this->Adresa;
    }

    public function setAdresa(string $Adresa): static {
        $this->Adresa = $Adresa;

        return $this;
    }

    public function getCategorie(): ?string {
        return $this->Categorie;
    }

    public function setCategorie(string $Categorie): static {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function getLogo(): ?string {
        return $this->Logo;
    }

    public function setLogo(string $Logo): static {
        $this->Logo = $Logo;

        return $this;
    }

    public function getVizualizare(): ?int {
        return $this->Vizualizare;
    }

    public function setVizualizare(?int $Vizualizare): static {
        $this->Vizualizare = $Vizualizare;

        return $this;
    }
}
