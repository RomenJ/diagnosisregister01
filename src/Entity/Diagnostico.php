<?php

namespace App\Entity;

use App\Repository\DiagnosticoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiagnosticoRepository::class)]
class Diagnostico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'diagnosticos')]
    private ?Paciente $paciente = null;

    #[ORM\ManyToMany(targetEntity: Pato::class, inversedBy: 'diagnosticos')]
    private Collection $patologias;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notas = null;

    public function __construct()
    {
        $this->patologias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPaciente(): ?Paciente
    {
        return $this->paciente;
    }

    public function setPaciente(?Paciente $paciente): self
    {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * @return Collection<int, Pato>
     */
    public function getPatologias(): Collection
    {
        return $this->patologias;
    }

    public function addPatologia(Pato $patologia): self
    {
        if (!$this->patologias->contains($patologia)) {
            $this->patologias->add($patologia);
        }

        return $this;
    }

    public function removePatologia(Pato $patologia): self
    {
        $this->patologias->removeElement($patologia);

        return $this;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(?string $notas): self
    {
        $this->notas = $notas;

        return $this;
    }
    
    public function __toString()
    {
        return $this->date;
    
    }
}
