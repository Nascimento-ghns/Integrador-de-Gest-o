<?php
class OSv
{
    private ?int $id;
    private ?string $tecnicos;
    private ?string $equipamentosAfetados;
    private ?string $matConsumo;
    private ?string $matConsumoDuravel;
    private ?string $matPermanente;
    private ?string $matPermanenteRemovido;
    private ?string $pedidoMaterial;
    private ?string $quantidadeMaterial;

    public function __construct(?int $id, ?string $tecnicos, ?string $equipamentosAfetados, ?string $matConsumo, ?string $matConsumoDuravel, ?string $matPermanente, ?string $matPermanenteRemovido, ?string $pedidoMaterial, ?string $quantidadeMaterial)
    {
        $this->id = $id;
        $this->tecnicos = $tecnicos;
        $this->equipamentosAfetados = $equipamentosAfetados;
        $this->matConsumo = $matConsumo;
        $this->matConsumoDuravel = $matConsumoDuravel;
        $this->matPermanente = $matPermanente;
        $this->matPermanenteRemovido = $matPermanenteRemovido;
        $this->pedidoMaterial = $pedidoMaterial;
        $this->quantidadeMaterial = $quantidadeMaterial;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTecnicos(): ?string
    {
        return $this->tecnicos;
    }


    public function getEquipamentosAfetados(): ?string
    {
        return $this->equipamentosAfetados;
    }

    public function getMatConsumo(): ?string
    {
        return $this->matConsumo;
    }
    
    public function getMatConsumoDuravel(): ?string
    {
        return $this->matConsumoDuravel;
    }
    
    public function getMatPermanente(): ?string
    {
        return $this->matPermanente;
    }
    
    public function getMatPermanenteRemovido(): ?string
    {
        return $this->matPermanenteRemovido;
    }
    
    public function getPedidoMaterial(): ?string
    {
        return $this->pedidoMaterial;
    }
    
    public function getQuantidadeMaterial(): ?string
    {
        return $this->quantidadeMaterial;
    }
    
}