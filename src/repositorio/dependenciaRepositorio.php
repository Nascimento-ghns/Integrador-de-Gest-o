<?php

class dependenciaRepositorio
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
        return new Dependencia(
            $dados['depId'],
            $dados['depNome']
        );
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM dependencia";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($dependencia){
            return $this->formarObjeto($dependencia);
        },$dados);

        return $todosOsDados;
    }

    public function buscar(int $depId)
    {
        $sql = "SELECT * FROM dependencia WHERE depId = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $depId);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

}