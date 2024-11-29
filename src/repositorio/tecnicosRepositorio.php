<?php

class tecnicoRepositorio
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
        return new Tecnico(
            $dados['tecnicoId'],
            $dados['tecnicoNome']
        );
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM tecnicos";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($tipo){
            return $this->formarObjeto($tipo);
        },$dados);

        return $todosOsDados;
    }

    public function buscar(int $tecnicoId)
    {
        $sql = "SELECT * FROM tecnicos WHERE tecnicoId = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $tecnicoId);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

}