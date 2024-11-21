<?php
class Tipo
{
    private ?int $tipoId;
    private string $tipoNome;

    public function __construct(?int $tipoId, string $tipoNome)
    {
        $this->tipoId = $tipoId;
        $this->tipoNome = $tipoNome;
    }

    public function getId(): ?int
    {
        return $this->tipoId;
    }


    public function getNome(): string
    {
        return $this->tipoNome;
    }

}