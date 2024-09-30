<?php

class usuarioRepositorio
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
        return new Usuario($dados['id'],
            $dados['nome'],
            $dados['email'],
            $dados['senha'],
            $dados['acesso'],
            $dados['funcao']
        );
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM usuario";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($usuario){
            return $this->formarObjeto($usuario);
        },$dados);

        return $todosOsDados;
    }

    public function deletar(int $id)
    {
        $sql = "DELETE FROM usuario WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$id);
        $statement->execute();

    }

    public function salvar(Usuario $usuario)
    {
        $sql = "INSERT INTO usuario (usuarioNome, email, senha, funcao) VALUES (?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $usuario->getNome());
        $statement->bindValue(2, $usuario->getEmail());
        $statement->bindValue(3, $usuario->getSenha());
        $statement->bindValue(4,$usuario->getFuncao());
        $statement->execute();
    }

}