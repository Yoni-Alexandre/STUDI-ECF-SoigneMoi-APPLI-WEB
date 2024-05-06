<?php

namespace App\Entity;

use App\Repository\RendezVousUtilisateurRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousUtilisateurRepository::class)]
class RendezVousUtilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVousUtilisateurs')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVousUtilisateurs')]
    private ?Medecin $medecin = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $motifDeSejour = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVousUtilisateurs')]
    private ?SpecialiteMedecin $specialite = null;

    #[ORM\ManyToOne(inversedBy: 'rendezVousUtilisateurs')]
    private ?PlanningMedecin $planningMedecin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getMotifDeSejour(): ?string
    {
        return $this->motifDeSejour;
    }

    public function setMotifDeSejour(string $motifDeSejour): static
    {
        $this->motifDeSejour = $motifDeSejour;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getSpecialite(): ?SpecialiteMedecin
    {
        return $this->specialite;
    }

    public function setSpecialite(?SpecialiteMedecin $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getPlanningMedecin(): ?PlanningMedecin
    {
        return $this->planningMedecin;
    }

    public function setPlanningMedecin(?PlanningMedecin $planningMedecin): static
    {
        $this->planningMedecin = $planningMedecin;

        return $this;
    }
}
