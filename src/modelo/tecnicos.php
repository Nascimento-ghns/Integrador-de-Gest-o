<?php
class Tecnico
{
    private ?int $tecnicoId;
    private string $tecnicoNome;

    public function __construct(?int $tecnicoId, string $tecnicoNome)
    {
        $this->tecnicoId = $tecnicoId;
        $this->tecnicoNome = $tecnicoNome;
    }

    public function getId(): ?int
    {
        return $this->tecnicoId;
    }


    public function getNome(): string
    {
        return $this->tecnicoNome;
    }

}