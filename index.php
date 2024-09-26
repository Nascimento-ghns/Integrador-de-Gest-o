<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="bibliotecas/css/bootstrap.css">
    <link rel="stylesheet" href="bibliotecas/js/bootstrap.js">
    <link rel="stylesheet" href="css/estilo.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrador de Gestão</title>
</head>
<body>
    
    <div class="container-fluid" id="corpo">
        <div  class="row" id="login">
            <div class="offset-4 col-md-4">
                <div class="container">
                    <form action="" id="formLogin" class="fundoCinza">
                        <h1 class="centralizaTitulo">Login</h1>
                        <hr>
                        <label for="email">Email:</label>
                        <input type="text" placeholder="digite seu email">
                        <br>
                        <label for="senha">Senha:</label>
                        <input type="text" placeholder="digite sua senha">
                        <br>
                        <hr>
                        <button type="button" class="btn btn-success">Entrar</button>
                        <button type="button" class="btn btn-danger">Cancelar</button>
                        <button type="button" class="btn btn-warning">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>