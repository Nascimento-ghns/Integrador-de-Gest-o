<?php

class tipoRepositorio
{
    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {
        return new Tipo(
            $dados['tipoId'],
            $dados['tipoNome']
        );
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM tipo";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($tipo){
            return $this->formarObjeto($tipo);
        },$dados);

        return $todosOsDados;
    }

    public function buscar(int $tipoId)
    {
        $sql = "SELECT * FROM tipo WHERE tipoId = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $tipoId);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

}