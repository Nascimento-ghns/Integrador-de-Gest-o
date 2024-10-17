<?php

class Material{

    private ?int $id;
    private string $nome;
    private string $descricao;
    private string $fabricante;
    private string $modelo;
    private string $tipo;
    private int $quantidade;
    private string $dataInclusao;
    private ?string $dataBaixa;
    private ?float $valorCarga;
    private ?string $dataValorCotacao;
    private ?float $valorCotacao;
    private int $prevAlocDep;
    private ?string $catMat;
    private ?int $numSerie;

    public function __construct(?int $id, string $nome, string $descricao, string $fabricante, string $modelo, string $tipo, int $quantidade, string $dataInclusao, ?string $dataBaixa, ?float $valorCarga, ?string $dataValorCotacao, ?float $valorCotacao, int $prevAlocDep, ?string $catMat, ?int $numSerie)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->fabricante = $fabricante;
        $this->modelo = $modelo;
        $this->tipo = $tipo;
        $this->quantidade = $quantidade;
        $this->dataInclusao = $dataInclusao;
        $this->dataBaixa = $dataBaixa;
        $this->valorCarga = $valorCarga;
        $this->dataValorCotacao = $dataValorCotacao;
        $this->valorCotacao = $valorCotacao;
        $this->prevAlocDep = $prevAlocDep;
        $this->catMat = $catMat;
        $this->numSerie = $numSerie;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getNome(): string
    {
        return $this->nome;
    }


    public function getDescricao(): string
    {
        return $this->descricao;
    }


    public function getFabricante(): string
    {
        return $this->fabricante;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function getDataInclusao(): string
    {
        return $this->dataInclusao;
    }

    public function getDataBaixa(): string
    {
        return $this->dataBaixa;
    }

    public function getValorCarga(): float
    {
        return $this->valorCarga;
    }

    public function getDataValorCotacao(): string
    {
        return $this->dataValorCotacao;
    }

    public function getValorCotacao(): float
    {
        return $this->valorCotacao;
    }

    public function getPrevAlocDep(): int
    {
        return $this->prevAlocDep;
    }
    
    public function getCatMat(): string
    {
        return $this->catMat;
    }

    public function getNumSerie(): int
    {
        return $this->numSerie;
    }

}

?>