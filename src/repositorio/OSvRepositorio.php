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

    public function buscarMaterialTipo(int $numOrdem)
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

    public function salvarEquipamentoAfetado(OSv $OSv, int $ordemNum)
    {
        $nomeTab = "os".$ordemNum;
        $sql = "INSERT INTO $nomeTab (equipamentosAfetados) VALUES (?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $OSv->getEquipamentosAfetados());
        $statement->execute();
    }

    public function salvarMaterialConsumo(OSv $OSv, int $ordemNum)
    {
        $nomeTab = "os".$ordemNum;
        $sql = "INSERT INTO $nomeTab (matConsumo) VALUES (?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $OSv->getMatConsumo());
        $statement->execute();
    }

    public function salvarMaterialConsumoDuravel(OSv $OSv, int $ordemNum)
    {
        $nomeTab = "os".$ordemNum;
        $sql = "INSERT INTO $nomeTab (matConsumoDuravel) VALUES (?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $OSv->getMatConsumoDuravel());
        $statement->execute();
    }

    public function salvarMaterialPermanente(OSv $OSv, int $ordemNum)
    {
        $nomeTab = "os".$ordemNum;
        $sql = "INSERT INTO $nomeTab (matPermanente) VALUES (?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $OSv->getMatPermanente());
        $statement->execute();
    }

    public function salvarMaterialPermanenteRemovido(OSv $OSv, int $ordemNum)
    {
        $nomeTab = "os".$ordemNum;
        $sql = "INSERT INTO $nomeTab (matPermanenteRemovido) VALUES (?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $OSv->getMatPermanenteRemovido());
        $statement->execute();
    }

    public function excluirTecnico(string $nomeTecnico, int $num)
    {
        $sql = "DELETE FROM os$num WHERE tecnicos = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$nomeTecnico);
        $statement->execute();

    }

    public function excluirEquipamentoAfetado(int $equipamentoAfetado, int $num)
    {
        $sql = "DELETE FROM os$num WHERE equipamentosAfetados = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$equipamentoAfetado);
        $statement->execute();

    }

    public function excluirMatConsumo(string $matConsumo, int $num)
    {
        $sql = "DELETE FROM os$num WHERE matConsumo = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$matConsumo);
        $statement->execute();

    }

    public function excluirMatConsumoDuravel(string $matConsumo, int $num)
    {
        $sql = "DELETE FROM os$num WHERE matConsumoDuravel = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$matConsumo);
        $statement->execute();

    }

    public function excluirMatPermanente(string $matPermanente, int $num)
    {
        $sql = "DELETE FROM os$num WHERE matPermanente = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$matPermanente);
        $statement->execute();

    }

    public function excluirMatPermanenteRemovido(string $matPermanenteRemovido, int $num)
    {
        $sql = "DELETE FROM os$num WHERE matPermanenteRemovido = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$matPermanenteRemovido);
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