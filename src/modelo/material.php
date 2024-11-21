<?php

class Material{

    private ?int $matId;
    private string $matNome;
    private string $matDescricao;
    private string $matFabricante;
    private string $matModelo;
    private ?int $matTipo;
    private int $matQuant;
    private string $matDataInclusao;
    private ?string $matDataBaixa;
    private ?float $matValorCarga;
    private ?string $matDataValorCotacao;
    private ?float $matValorCotacao;
    private ?int $matPrevAlocDep;
    private ?string $matCatMat;
    private ?string $matNumSerie;

    public function __construct(?int $matId, string $matNome, string $matDescricao, string $matFabricante, string $matModelo, ?int $matTipo, int $matQuant, string $matDataInclusao, ?string $matDataBaixa, ?float $matValorCarga, ?string $matDataValorCotacao, ?float $matValorCotacao, ?int $matPrevAlocDep, ?string $matCatMat, ?string $matNumSerie)
    {
        $this->matId = $matId;
        $this->matNome = $matNome;
        $this->matDescricao = $matDescricao;
        $this->matFabricante = $matFabricante;
        $this->matModelo = $matModelo;
        $this->matTipo = $matTipo;
        $this->matQuant = $matQuant;
        $this->matDataInclusao = $matDataInclusao;
        $this->matDataBaixa = $matDataBaixa;
        $this->matValorCarga = $matValorCarga;
        $this->matDataValorCotacao = $matDataValorCotacao;
        $this->matValorCotacao = $matValorCotacao;
        $this->matPrevAlocDep = $matPrevAlocDep;
        $this->matCatMat = $matCatMat;
        $this->matNumSerie = $matNumSerie;
    }

    public function getId(): int
    {
        return $this->matId;
    }


    public function getNome(): string
    {
        return $this->matNome;
    }


    public function getDescricao(): string
    {
        return $this->matDescricao;
    }


    public function getFabricante(): string
    {
        return $this->matFabricante;
    }

    public function getModelo(): string
    {
        return $this->matModelo;
    }

    public function getTipo(): ?int
    {
        return $this->matTipo;
    }

    public function getQuant(): int
    {
        return $this->matQuant;
    }

    public function getDataInclusao(): string
    {
        return $this->matDataInclusao;
    }

    public function getDataBaixa(): ?string
    {
        return $this->matDataBaixa;
    }

    public function getValorCarga(): ?float
    {
        return $this->matValorCarga;
    }

    public function getDataValorCotacao(): ?string
    {
        return $this->matDataValorCotacao;
    }

    public function getValorCotacao(): ?float
    {
        return $this->matValorCotacao;
    }

    public function getPrevAlocDep(): ?int
    {
        return $this->matPrevAlocDep;
    }
    
    public function getCatMat(): ?string
    {
        return $this->matCatMat;
    }

    public function getNumSerie(): ?string
    {
        return $this->matNumSerie;
    }

}

?>