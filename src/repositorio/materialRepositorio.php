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
        return new Material($dados['matId'],
            $dados['matNome'],
            $dados['matDescricao'],
            $dados['matFabricante'],
            $dados['matModelo'],
            $dados['matTipo'],
            $dados['matQuant'],
            $dados['matDataInclusao'],
            $dados['matDataBaixa'],
            $dados['matValorCarga'],
            $dados['matDataValorCotacao'],
            $dados['matValorCotacao'],
            $dados['matPrevAlocDep'],
            $dados['matCatMat'],
            $dados['matNumSerie']
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

    public function buscarDependencia($depId)
    {
        $sql = "SELECT * FROM material where matPrevAlocDep = $depId";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($material){
            return $this->formarObjeto($material);
        },$dados);

        return $todosOsDados;
    }

    public function salvar(Material $material)
    {
        $sql = "INSERT INTO material (matNome, matDescricao, matFabricante, matModelo, matTipo, matQuant, matDataInclusao, matDataBaixa, matValorCarga, matDataValorCotacao, matValorCotacao, matPrevAlocDep, matCatMat, matNumSerie) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $material->getNome());
        $statement->bindValue(2, $material->getDescricao());
        $statement->bindValue(3, $material->getFabricante());
        $statement->bindValue(4, $material->getModelo());
        $statement->bindValue(5, $material->getTipo());
        $statement->bindValue(6, $material->getQuant());
        $statement->bindValue(7, $material->getDataInclusao());
        $statement->bindValue(8, $material->getDataBaixa());
        $statement->bindValue(9, $material->getValorCarga());
        $statement->bindValue(10, $material->getDataValorCotacao());
        $statement->bindValue(11, $material->getValorCotacao());
        $statement->bindValue(12, $material->getPrevAlocDep());
        $statement->bindValue(13, $material->getCatMat());
        $statement->bindValue(14, $material->getNumSerie());
        $statement->execute();
    }

    public function buscar(int $matId)
    {
        $sql = "SELECT * FROM material WHERE matId = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $matId);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    public function buscarMaterial(int $matTipo)
    {
        $sql = "SELECT * FROM material WHERE matTipo = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $matTipo);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    public function excluir(int $matId)
    {
        $sql = "DELETE FROM material WHERE matId = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$matId);
        $statement->execute();

    }

    public function atualizar(Material $material)
    {
        $sql = "UPDATE material SET matNome = ?, matDescricao = ?, matFabricante = ?, matModelo = ?, matTipo = ?, matQuant = ?, matDataInclusao = ?, matDataBaixa = ?, matValorCarga = ?, matDataValorCotacao = ?, matValorCotacao = ?, matPrevAlocDep = ?, matCatMat = ?, matNumSerie = ? WHERE matId = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $material->getNome());
        $statement->bindValue(2, $material->getDescricao());
        $statement->bindValue(3, $material->getFabricante());
        $statement->bindValue(4, $material->getModelo());
        $statement->bindValue(5, $material->getTipo());
        $statement->bindValue(6, $material->getQuant());
        $statement->bindValue(7, $material->getDataInclusao());
        $statement->bindValue(8, $material->getDataBaixa());
        $statement->bindValue(9, $material->getValorCarga());
        $statement->bindValue(10, $material->getDataValorCotacao());
        $statement->bindValue(11, $material->getValorCotacao());
        $statement->bindValue(12, $material->getPrevAlocDep());
        $statement->bindValue(13, $material->getCatMat());
        $statement->bindValue(14, $material->getNumSerie());
        $statement->bindValue(15, $material->getId());
        $statement->execute();
    }

}