<?php

namespace App\Entity;

use App\Repository\DateViewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateViewRepository::class)]
class DateView
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'dateview')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Company $data = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateforview = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?Company
    {
        return $this->data;
    }

    public function setData(?Company $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getDateforview(): ?\DateTimeInterface
    {
        return $this->dateforview;
    }

    public function setDateforview(\DateTimeInterface $dateforview): static
    {
        $this->dateforview = $dateforview;

        return $this;
    }
}
