<?php

class OSvRepositorio
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
        return new OSv(
            $dados['id'],
            $dados['tecnicos'],
            $dados['equipamentosAfetados'],
            $dados['matConsumo'],
            $dados['matConsumoDuravel'],
            $dados['matPermanente'],
            $dados['matPermanenteRemovido'],
            $dados['pedidoMaterial'],
            $dados['quantidadeMaterial']
        );
    }

    public function buscarTodos(int $numOrdem)
    {
        $sql = "SELECT * FROM os$numOrdem";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($os){
            return $this->formarObjeto($os);
        },$dados);

        return $todosOsDados;
    }

    public function salvarTecnico(OSv $OSv, int $ordemNum)
    {
        $nomeTab = "os".$ordemNum;
        $sql = "INSERT INTO $nomeTab (tecnicos) VALUES (?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $OSv->getTecnicos());
        $statement->execute();
    }

    public function excluirTecnico(string $nomeTecnico, int $num)
    {
        $sql = "DELETE FROM os$num WHERE tecnicos = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$nomeTecnico);
        $statement->execute();

    }

    public function salvarEquipamentoAfetado(OSv $OSv, int $ordemNum)
    {
        $nomeTab = "os".$ordemNum;
        $sql = "INSERT INTO $nomeTab (equipamentosAfetados) VALUES (?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $OSv->getEquipamentosAfetados());
        $statement->execute();
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