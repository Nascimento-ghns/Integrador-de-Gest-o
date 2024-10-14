<?php
    require "src/conexaoBD.php";
    require "src/modelo/usuario.php";
    require "src/repositorio/usuarioRepositorio.php";

    if (isset($_POST['login'])){
        $usuarioRepositorio = new usuarioRepositorio($pdo);
        $usuarioRepositorio->logarUsuario($_POST['email'], $_POST['senha']);
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
            $("#criaUsuario").click(function(){
                location.href = "cadastroUsuario.php"  /* Redireciona para a página de cadastro de usuário */
            })
        });
    </script>
</head>
<body>
    
    <div class="container-fluid" id="corpo">
        <div  class="row" id="login">
            <div class="offset-4 col-md-4">
                <div class="container">
                    <form action="" method="post" class="fundoCinza form">
                        <h1 class="centralizaTitulo">Login</h1>
                        <hr>
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" placeholder="digite seu email">
                        <br>
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" placeholder="digite sua senha">
                        <br>
                        <hr>
                        <button type="submit" name="login" class="btn btn-success">Entrar</button>
                        <button type="reset" class="btn btn-danger">Cancelar</button>
                        <button id="criaUsuario" name="criaUsuario" type="button" class="btn btn-warning" onclick="">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>