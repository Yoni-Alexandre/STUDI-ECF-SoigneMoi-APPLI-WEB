<?php

namespace App\Entity;

use App\Repository\PrescriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrescriptionRepository::class)]
class Prescription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutTraitement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinTraitement = null;

    #[ORM\ManyToOne(inversedBy: 'prescription')]
    private ?Medicament $medicament = null;

    #[ORM\ManyToOne(inversedBy: 'prescription')]
    private ?Medecin $medecin = null;

    /**
     * @var Collection<int, Avis>
     */
    #[ORM\OneToMany(targetEntity: Avis::class, mappedBy: 'prescription')]
    private Collection $avis;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getDateDebutTraitement(): ?\DateTimeInterface
    {
        return $this->dateDebutTraitement;
    }

    public function setDateDebutTraitement(\DateTimeInterface $dateDebutTraitement): static
    {
        $this->dateDebutTraitement = $dateDebutTraitement;

        return $this;
    }

    public function getDateFinTraitement(): ?\DateTimeInterface
    {
        return $this->dateFinTraitement;
    }

    public function setDateFinTraitement(\DateTimeInterface $dateFinTraitement): static
    {
        $this->dateFinTraitement = $dateFinTraitement;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): static
    {
        $this->medicament = $medicament;

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


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
    /**
     * @return Collection<int, Avis>
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvis(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setPrescription($this);
        }

        return $this;
    }

    public function removeAvis(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getPrescription() === $this) {
                $avi->setPrescription(null);
            }
        }

        return $this;
    }
}
