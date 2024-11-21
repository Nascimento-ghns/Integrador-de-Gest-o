<?php
class Dependencia
{
    private ?int $depId;
    private string $depNome;

    public function __construct(?int $depId, string $depNome)
    {
        $this->depId = $depId;
        $this->depNome = $depNome;
    }

    public function getId(): ?int
    {
        return $this->depId;
    }


    public function getNome(): string
    {
        return $this->depNome;
    }

}