<?php

class ordemSvRepositorio
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
        return new OrdemSv(
            $dados['ordemId'],
            $dados['ordemAutor'],
            $dados['ordemDataInicio'],
            $dados['ordemDataTermino'],
            $dados['ordemTempoTranscorrido'],
            $dados['ordemDescricao'],
            $dados['ordemDependencia'],
            $dados['ordemNum'],
            $dados['ordemAno'],
            $dados['ordemTipoMnt'],
            $dados['ordemEstadoFinal'],
            $dados['ordemDataInicioMnt'],
            $dados['ordemDataFimMnt'],
            $dados['ordemHoraInicioMnt'],
            $dados['ordemHoraFimMnt'],
            $dados['ordemHomemHora'],
            $dados['ordemDiasAteIniciar'],
            $dados['ordemDiasTrabalhados']
        );
    }

    public function salvar(OrdemSv $ordemSv)
    {
        $nome = "os".$ordemSv->getNum();
        $sql = "INSERT INTO ordemsv (ordemAutor, ordemDataInicio, ordemDataTermino, ordemTempoTranscorrido, ordemDescricao, ordemDependencia, ordemNum, ordemAno) VALUES (?,?,?,?,?,?,?,?); Create table $nome(id int AUTO_INCREMENT PRIMARY KEY, tecnicos varchar(255) unique, equipamentosAfetados varchar(255), matConsumo varchar(255), matConsumoDuravel varchar(255), matPermanente varchar(255), matPermanenteRemovido varchar(255), pedidoMaterial varchar(255), quantidadeMaterial int);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $ordemSv->getAutor());
        $statement->bindValue(2, $ordemSv->getDataInicio());
        $statement->bindValue(3, $ordemSv->getDataTermino());
        $statement->bindValue(4, $ordemSv->getTempoTranscorrido());
        $statement->bindValue(5, $ordemSv->getDescricao());
        $statement->bindValue(6, $ordemSv->getDependencia());
        $statement->bindValue(7, $ordemSv->getNum());
        $statement->bindValue(8, $ordemSv->getAno());
        $statement->execute();
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM ordemsv";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($ordemSv){
            return $this->formarObjeto($ordemSv);
        },$dados);

        return $todosOsDados;
    }

    public function numeroOrdem()
    {
        $sql = "SELECT * FROM ordemsv where (SELECT max(ordemNum) from ordemsv)";
        $statement = $this->pdo->query($sql);
        $statement->execute();
        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        if($dados != false){
            return $this->formarObjeto($dados);
        }
    }

    public function buscar(int $ordemId)
    {
        $sql = "SELECT * FROM ordemsv WHERE ordemId = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $ordemId);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    public function buscarPorNumero(int $ordemNum)
    {
        $sql = "SELECT * FROM ordemsv WHERE ordemNum = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $ordemNum);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }

    public function salvarDataInicioMnt(int $ordemNum)
    {
        $sql = "UPDATE ordemsv SET ordemDataInicioMnt = ? WHERE ordemNum = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, date("Y-m-d"));
        $statement->bindValue(2, $ordemNum);
        $statement->execute();
    }

    public function salvarHoraInicioMnt(int $ordemNum, DateTime $agora)
    {
        $sql = "UPDATE ordemsv SET ordemHoraInicioMnt = ? WHERE ordemNum = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $agora->format('H:i'));
        $statement->bindValue(2, $ordemNum);
        $statement->execute();
    }

    public function calculaDiasAteIniciar(OrdemSv $ordemSv)
    {
        $data_inicio = new DateTime($ordemSv->getDataInicio());
        $data_inicioMnt = new DateTime($ordemSv->getDataInicioMnt());
        $dateInterval = $data_inicio->diff($data_inicioMnt);
        $sql = "UPDATE ordemsv SET ordemDiasAteIniciar = ? WHERE ordemNum = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $dateInterval->days);
        $statement->bindValue(2, $ordemSv->getNum());
        $statement->execute();
    }

    public function finalizarOrdem(int $ordemNum)
    {
        $sql = "UPDATE ordemsv SET ordemEstadoFinal = ? WHERE ordemNum = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, 'finalizado');
        $statement->bindValue(2, $ordemNum);
        $statement->execute();
    }

    public function excluir(int $ordemNum)
    {
        $nomeTabela = 'os'.$ordemNum;
        $sql = "DELETE FROM ordemsv WHERE ordemNum = ?; drop table $nomeTabela;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$ordemNum);
        $statement->execute();
    }

}