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
    private ?string $ordemTipoMnt;
    private ?string $ordemEstadoFinal;
    private ?string $ordemDataInicioMnt;
    private ?string $ordemDataFimMnt;
    private ?string $ordemHoraInicioMnt;
    private ?string $ordemHoraFimMnt;
    private ?string $ordemHomemHora;
    private ?string $ordemDiasAteIniciar;
    private ?string $ordemDiasTrabalhados;

    public function __construct(?int $ordemId, string $ordemAutor, string $ordemDataInicio, ?string $ordemDataTermino, ?string $ordemTempoTranscorrido, string $ordemDescricao, string $ordemDependencia, int $ordemNum, int $ordemAno, ?string $ordemTipoMnt, ?string $ordemEstadoFinal, ?string $ordemDataInicioMnt, ?string $ordemDataFimMnt, ?string $ordemHoraInicioMnt, ?string $ordemHoraFimMnt, ?string $ordemHomemHora, ?string $ordemDiasAteIniciar, ?string $ordemDiasTrabalhados)
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
        $this->ordemTipoMnt = $ordemTipoMnt;
        $this->ordemEstadoFinal = $ordemEstadoFinal;
        $this->ordemDataInicioMnt = $ordemDataInicioMnt;
        $this->ordemDataFimMnt = $ordemDataFimMnt;
        $this->ordemHoraInicioMnt = $ordemHoraInicioMnt;
        $this->ordemHoraFimMnt = $ordemHoraFimMnt;
        $this->ordemHomemHora = $ordemHomemHora;
        $this->ordemDiasAteIniciar = $ordemDiasAteIniciar;
        $this->ordemDiasTrabalhados = $ordemDiasTrabalhados;
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

    public function getTipoMnt(): ?string
    {
        return $this->ordemTipoMnt;
    }


    public function getEstadoFinal(): ?string
    {
        return $this->ordemEstadoFinal;
    }

    public function getDataInicioMnt(): ?string
    {
        return $this->ordemDataInicioMnt;
    }

    public function getDataFimMnt(): ?string
    {
        return $this->ordemDataFimMnt;
    }

    public function getHoraInicioMnt(): ?string
    {
        return $this->ordemHoraInicioMnt;
    }

    public function getHoraFimMnt(): ?string
    {
        return $this->ordemHoraFimMnt;
    }

    public function getHomemHora(): ?string
    {
        return $this->ordemDependencia;
    }

    public function getDiasAteIniciar(): ?string
    {
        return $this->ordemDiasAteIniciar;
    }

    public function getDiasTrabalhados(): ?string
    {
        return $this->ordemDiasTrabalhados;
    }

}