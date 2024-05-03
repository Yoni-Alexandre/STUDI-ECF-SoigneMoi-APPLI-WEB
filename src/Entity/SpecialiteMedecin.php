<?php

namespace App\Entity;

use App\Repository\SpecialiteMedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialiteMedecinRepository::class)]
class SpecialiteMedecin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $specialite = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(targetEntity: Medecin::class, mappedBy: 'specialite')]
    private Collection $medecins;

    /**
     * @var Collection<int, RendezVousUtilisateur>
     */
    #[ORM\OneToMany(targetEntity: RendezVousUtilisateur::class, mappedBy: 'specialite')]
    private Collection $rendezVousUtilisateurs;

    public function __construct()
    {
        $this->medecins = new ArrayCollection();
        $this->rendezVousUtilisateurs = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->specialite;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Medecin>
     */
    public function getMedecins(): Collection
    {
        return $this->medecins;
    }

    public function addMedecin(Medecin $medecin): static
    {
        if (!$this->medecins->contains($medecin)) {
            $this->medecins->add($medecin);
            $medecin->setSpecialite($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): static
    {
        if ($this->medecins->removeElement($medecin)) {
            // set the owning side to null (unless already changed)
            if ($medecin->getSpecialite() === $this) {
                $medecin->setSpecialite(null);
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
            $rendezVousUtilisateur->setSpecialite($this);
        }

        return $this;
    }

    public function removeRendezVousUtilisateur(RendezVousUtilisateur $rendezVousUtilisateur): static
    {
        if ($this->rendezVousUtilisateurs->removeElement($rendezVousUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($rendezVousUtilisateur->getSpecialite() === $this) {
                $rendezVousUtilisateur->setSpecialite(null);
            }
        }

        return $this;
    }
}
