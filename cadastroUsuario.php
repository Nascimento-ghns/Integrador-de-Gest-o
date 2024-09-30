<?php
    require "src/conexaoBD.php";
    require "src/modelo/usuario.php";
    require "src/repositorio/usuarioRepositorio.php";

    if (isset($_POST['cadastro'])){
            $usuario = new Usuario(null,
            $_POST['nome'],
            $_POST['email'],
            $_POST['senha'],
            null,
            $_POST['funcao']
        );

        $usuarioRepositorio = new usuarioRepositorio($pdo);
        $usuarioRepositorio->salvar($usuario);

        header("Location: login.php");

    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="bibliotecas/css/bootstrap.css">
    <script src="bibliotecas/js/jQuery.js"></script>
    <script src="bibliotecas/js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/estilo.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrador de Gestão</title>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#cancelarCadastro").click(function(){
                location.href = "login.php"  /* Redireciona para a página de cadastro de usuário */
            })
        });
    </script>
</head>
<body>
    
    <div class="container-fluid" id="corpo">
        <div  class="row" id="login">
            <div class="offset-4 col-md-4">
                <div class="container">
                    <form method="post" class="fundoCinza form">
                        <h1 class="centralizaTitulo">Cadastro</h1>
                        <hr>
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="digite seu nome">
                        <br>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="digite seu email">
                        <br>
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="digite sua senha">
                        <br>
                        <label for="funcao">Qual sua função:</label>
                        <input type="text" id="funcao" name="funcao" placeholder="digite sua função">
                        <br>
                        <hr>
                        <button type="submit" name="cadastro" class="btn btn-success">Cadastrar</button>
                        <button type="button" class="btn btn-danger" id="cancelarCadastro">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>