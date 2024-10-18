<?php

class materialRepositorio
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
        return new Material($dados['id'],
            $dados['nome'],
            $dados['descricao'],
            $dados['fabricante'],
            $dados['modelo'],
            $dados['tipo'],
            $dados['quantidade'],
            $dados['dataInclusao'],
            $dados['dataBaixa'],
            $dados['valorCarga'],
            $dados['dataValorCotacao'],
            $dados['valorCotacao'],
            $dados['prevAlocDep'],
            $dados['catMat'],
            $dados['numSerie']
        );
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM material";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($material){
            return $this->formarObjeto($material);
        },$dados);

        return $todosOsDados;
    }

    public function deletar(int $id)
    {
        $sql = "DELETE FROM material WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();

    }

}