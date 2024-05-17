<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\AvisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: AvisRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/avis/{id}',
            normalizationContext: ['groups' => ['avis:read']]
        ),
        
        new GetCollection(
            uriTemplate: '/avis',
            normalizationContext: ['groups' => ['avis:read']],
            //security: "is_granted('ROLE_ADMIN')",
            //securityMessage: "Vous n'avez pas les droits pour accéder à cette ressource"
        ),

        new Post(
            uriTemplate: '/avis',
            denormalizationContext: ['groups' => ['avis:write']],
            //security: "is_granted('ROLE_ADMIN')",
            //securityMessage: "Vous n'avez pas les droits pour accéder à cette ressource"
        ),

        new Delete(
            uriTemplate: '/avis/{id}',
            //security: "is_granted('ROLE_ADMIN')",
            //securityMessage: "Vous n'avez pas les droits pour accéder à cette ressource"
        )
    ],
    normalizationContext: ['groups' => ['avis:read']],
    denormalizationContext: ['groups' => ['avis:write']]
)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['avis:read', 'avis:write'])]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['avis:read', 'avis:write'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['avis:read', 'avis:write'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    #[Groups(['avis:read', 'avis:write'])]
    private ?Medecin $medecin = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(targetEntity: Prescription::class, inversedBy: 'avis')]
    private ?Prescription $prescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
    public function getPrescription(): ?Prescription
    {
        return $this->prescription;
    }
    public function setPrescription(?Prescription $prescription): self
    {
        $this->prescription = $prescription;

        return $this;
    }
}
