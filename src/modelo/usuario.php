<?php
class Usuario
{
    private ?int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private ?int $acesso;
    private string $funcao;

    public function __construct(?int $id, string $nome, string $email, string $senha,  ?int $acesso, string $funcao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->acesso = $acesso;
        $this->funcao = $funcao;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getNome(): string
    {
        return $this->nome;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getSenha(): string
    {
        return $this->senha;
    }

    public function getAcesso(): string
    {
        return $this->acesso;
    }

    public function getFuncao(): string
    {
        return $this->funcao;
    }

}