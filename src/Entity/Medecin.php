<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\ManyToOne(inversedBy: 'medecins')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\OneToMany(targetEntity: Prescription::class, mappedBy: 'medecin')]
    private Collection $prescriptions;

    #[ORM\OneToMany(targetEntity: PlanningMedecin::class, mappedBy: 'medecin')]
    private Collection $planningMedecins;

    #[ORM\ManyToOne(inversedBy: 'medecins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SpecialiteMedecin $specialite = null;

    #[ORM\OneToMany(targetEntity: Utilisateur::class, mappedBy: 'medecins')]
    private Collection $utilisateurs;

    #[ORM\OneToMany(targetEntity: RendezVousUtilisateur::class, mappedBy: 'medecin')]
    private Collection $rendezVousUtilisateurs;

    public function __construct()
    {
        $this->prescriptions = new ArrayCollection();
        $this->planningMedecins = new ArrayCollection();
        $this->utilisateurs = new ArrayCollection();
        $this->rendezVousUtilisateurs = new ArrayCollection();
    }

    public function __toString(): string
    {
        return 'Dr ' . $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

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

    /**
     * @return Collection<int, Prescription>
     */
    public function getPrescriptions(): Collection
    {
        return $this->prescriptions;
    }

    public function addPrescription(Prescription $prescription): static
    {
        if (!$this->prescriptions->contains($prescription)) {
            $this->prescriptions->add($prescription);
            $prescription->setMedecin($this);
        }

        return $this;
    }

    public function removePrescription(Prescription $prescription): static
    {
        if ($this->prescriptions->removeElement($prescription)) {
            // set the owning side to null (unless already changed)
            if ($prescription->getMedecin() === $this) {
                $prescription->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlanningMedecin>
     */
    public function getPlanningMedecins(): Collection
    {
        return $this->planningMedecins;
    }

    public function addPlanningMedecin(PlanningMedecin $planningMedecin): static
    {
        if (!$this->planningMedecins->contains($planningMedecin)) {
            $this->planningMedecins->add($planningMedecin);
            $planningMedecin->setMedecin($this);
        }

        return $this;
    }

    public function removePlanningMedecin(PlanningMedecin $planningMedecin): static
    {
        if ($this->planningMedecins->removeElement($planningMedecin)) {
            // set the owning side to null (unless already changed)
            if ($planningMedecin->getMedecin() === $this) {
                $planningMedecin->setMedecin(null);
            }
        }

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

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setMedecins($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getMedecins() === $this) {
                $utilisateur->setMedecins(null);
            }
        }

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
            $rendezVousUtilisateur->setMedecin($this);
        }

        return $this;
    }

    public function removeRendezVousUtilisateur(RendezVousUtilisateur $rendezVousUtilisateur): static
    {
        if ($this->rendezVousUtilisateurs->removeElement($rendezVousUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($rendezVousUtilisateur->getMedecin() === $this) {
                $rendezVousUtilisateur->setMedecin(null);
            }
        }

        return $this;
    }
}
