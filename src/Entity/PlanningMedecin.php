<?php

namespace App\Entity;

use App\Repository\PlanningMedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanningMedecinRepository::class)]
class PlanningMedecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $nombre_patients_max = null;

    #[ORM\ManyToOne(inversedBy: 'planningMedecins')]
    private ?Medecin $medecin = null;

    /**
     * @var Collection<int, RendezVousUtilisateur>
     */
    #[ORM\OneToMany(targetEntity: RendezVousUtilisateur::class, mappedBy: 'planningMedecin')]
    private Collection $rendezVousUtilisateurs;

    public function __construct()
    {
        $this->rendezVousUtilisateurs = new ArrayCollection();
    }

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

    public function getNombrePatientsMax(): ?int
    {
        return $this->nombre_patients_max;
    }

    public function setNombrePatientsMax(int $nombre_patients_max): static
    {
        $this->nombre_patients_max = $nombre_patients_max;

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

    /**
     * @return Collection<int, RendezVousUtilisateur>
     */
    public function getRendezVousUtilisateurs(): Collection
    {
        return $this->rendezVousUtilisateurs;
    }

    public function addRendezVousUtilisateur(RendezVousUtilisateur $rendezVousUtilisateur): static
    {
        if (!$this->rendezVousUtilisateurs->contains($rendezVousUtilisateur)) {
            $this->rendezVousUtilisateurs->add($rendezVousUtilisateur);
            $rendezVousUtilisateur->setPlanningMedecin($this);
        }

        return $this;
    }

    public function removeRendezVousUtilisateur(RendezVousUtilisateur $rendezVousUtilisateur): static
    {
        if ($this->rendezVousUtilisateurs->removeElement($rendezVousUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($rendezVousUtilisateur->getPlanningMedecin() === $this) {
                $rendezVousUtilisateur->setPlanningMedecin(null);
            }
        }

        return $this;
    }
}
