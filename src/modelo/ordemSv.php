<?php
class OrdemSv
{
    private ?int $ordemId;
    private string $ordemAutor;
    private string $ordemDataInicio;
    private ?string $ordemDataTermino;
    private ?string $ordemTempoTranscorrido;
    private string $ordemDescricao;
    private string $ordemDependencia;
    private int $ordemNum;
    private int $ordemAno;

    public function __construct(?int $ordemId, string $ordemAutor, string $ordemDataInicio, ?string $ordemDataTermino, ?string $ordemTempoTranscorrido, string $ordemDescricao, string $ordemDependencia, int $ordemNum, int $ordemAno)
    {
        $this->ordemId = $ordemId;
        $this->ordemAutor = $ordemAutor;
        $this->ordemDataInicio = $ordemDataInicio;
        $this->ordemDataTermino = $ordemDataTermino;
        $this->ordemTempoTranscorrido = $ordemTempoTranscorrido;
        $this->ordemDescricao = $ordemDescricao;
        $this->ordemDependencia = $ordemDependencia;
        $this->ordemNum = $ordemNum;
        $this->ordemAno = $ordemAno;
    }

    public function getId(): ?int
    {
        return $this->ordemId;
    }


    public function getAutor(): string
    {
        return $this->ordemAutor;
    }

    public function getDataInicio(): string
    {
        return $this->ordemDataInicio;
    }

    public function getDataTermino(): ?string
    {
        return $this->ordemDataTermino;
    }

    public function getTempoTranscorrido(): ?string
    {
        return $this->ordemTempoTranscorrido;
    }

    public function getDescricao(): string
    {
        return $this->ordemDescricao;
    }

    public function getDependencia(): string
    {
        return $this->ordemDependencia;
    }

    public function getNum(): int
    {
        return $this->ordemNum;
    }

    public function getAno(): int
    {
        return $this->ordemAno;
    }

}