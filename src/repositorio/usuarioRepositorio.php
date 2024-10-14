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

    public function logarUsuario(string $email, int $senha)
    {
        $sql = "SELECT * FROM usuario where email = ? and senha = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1,$email);
        $statement->bindValue(2,$senha);
        $statement->execute();
        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->rowCount() == 1) {
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['acesso'] = $dados['acesso'];
            header('Location: index.php');
        }
        else{
            header('Location: login.php?sucesso=0');
        }
    }

}