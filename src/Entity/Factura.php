<?php

namespace App\Entity;

use App\Repository\FacturaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacturaRepository::class)]
class Factura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numerofactura = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datefactura = null;

    #[ORM\ManyToOne(inversedBy: 'facturas')]
    private ?Paciente $paciente = null;

    #[ORM\Column(nullable: true)]
    private ?float $iva = null;

    #[ORM\Column(nullable: true)]
    private ?float $irpf = null;

    #[ORM\Column(nullable: true)]
    private ?float $cantidadbaseimponible = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalfactura = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerofactura(): ?string
    {
        return $this->numerofactura;
    }

    public function setNumerofactura(string $numerofactura): self
    {
        $this->numerofactura = $numerofactura;

        return $this;
    }

    public function getDatefactura(): ?\DateTimeInterface
    {
        return $this->datefactura;
    }

    public function setDatefactura(?\DateTimeInterface $datefactura): self
    {
        $this->datefactura = $datefactura;

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

    public function getIva(): ?float
    {
        return $this->iva;
    }

    public function setIva(?float $iva): self
    {
        $this->iva = $iva;

        return $this;
    }

    public function getIrpf(): ?float
    {
        return $this->irpf;
    }

    public function setIrpf(?float $irpf): self
    {
        $this->irpf = $irpf;

        return $this;
    }

    public function getCantidadbaseimponible(): ?float
    {
        return $this->cantidadbaseimponible;
    }

    public function setCantidadbaseimponible(?float $cantidadbaseimponible): self
    {
        $this->cantidadbaseimponible = $cantidadbaseimponible;

        return $this;
    }

    public function getTotalfactura(): ?float
    {
        return $this->totalfactura;
    }

    public function setTotalfactura(?float $totalfactura): self
    {
        $this->totalfactura = $totalfactura;

        return $this;
    }
}
