<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'data', targetEntity: DateView::class)]
    private Collection $dateview;

    public function __construct()
    {
        $this->dateview = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, DateView>
     */
    public function getDateview(): Collection
    {
        return $this->dateview;
    }

    public function addDateview(DateView $dateview): static
    {
        if (!$this->dateview->contains($dateview)) {
            $this->dateview->add($dateview);
            $dateview->setData($this);
        }

        return $this;
    }

    public function removeDateview(DateView $dateview): static
    {
        if ($this->dateview->removeElement($dateview)) {
            // set the owning side to null (unless already changed)
            if ($dateview->getData() === $this) {
                $dateview->setData(null);
            }
        }

        return $this;
    }
}
