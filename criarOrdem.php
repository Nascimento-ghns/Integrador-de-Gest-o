<?php

    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/material.php";
    require "src/repositorio/materialRepositorio.php";
    require "src/modelo/dependencia.php";
    require "src/repositorio/dependenciaRepositorio.php";
    require "src/modelo/tipo.php";
    require "src/repositorio/tipoRepositorio.php";
    require "src/modelo/ordemSv.php";
    require "src/repositorio/ordemSvRepositorio.php";

    $dependenciaRepositorio = new dependenciaRepositorio($pdo);
    $dependencias = $dependenciaRepositorio->buscarTodos();

    $tipoRepositorio = new tipoRepositorio($pdo);
    $tipos = $tipoRepositorio->buscarTodos();

    $ordemSvRepositorio = new ordemSvRepositorio($pdo);
    $ordemSv = $ordemSvRepositorio->buscarTodos();
    $ordemNum = 0;
    foreach ($ordemSv as $ordemSv): 
        $ordemNum = $ordemNum + 1;
    endforeach;

    $anoAtual = date('Y');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="bibliotecas/css/bootstrap.css">
    <script src="bibliotecas/js/jQuery.js"></script>
    <link href="bibliotecasProforma/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bibliotecasProforma/js/bibliotecaBootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <script src="bibliotecas/js/formCadOrdem.js" defer></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrador de Gestão</title>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#incOrdem').submit(function(evento){
                
                evento.preventDefault();
					
					if (validarDados()) {
						
						var dados = jQuery( this ).serialize();
						
						$.ajax({
							type: "POST",
							url: "criarOrdem2.php",
							data: dados,
							success: function( resposta ) {		
								/*
									Se existir a palavra "Erro" na resposta recebida, colocar "Erro de Cadastramento" no título da janela de erro. Se não existir, colocar "Inclusão bem sucedida" no título da janela de sucesso. Emk ambos os casos, coloca no corpo da mensagem a resposta retornada pelo incEnd2.php
								*/
								if (resposta.indexOf("Erro") != -1 ) {
									$("#modalErroTitulo").html('Erro de Cadastramento');
									$("#modalErro").html( resposta );
									$("#janelaModalErro").modal();
								}
								else {
									$("#modalTextoTitulo").text("Inclusão bem sucedida");
									$("#modalTexto").html( resposta );
									$("#janelaModal").modal();
								}
							}
						});			
					}		
            });

        });
    </script>
</head>
<body>
    <div class="container-fluid" id="corpo">
        <?php require "src/require/navbarOrdem.php"; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 fundoDiv">
            <h1 class="centralizaTitulo">Cadastrar Ordem de Serviço</h1>
            <br>
                <form method="post" id="incOrdem" class="fundoCinza form">
                     <h2 class="text-right">Ordem de Serviço Nº<?=$anoAtual;?>/<?=str_pad($ordemNum+1 , 4 , '0' , STR_PAD_LEFT);?></h2>
                    <hr>
                    <label for="dataAbertura">Data de abertura:</label>
                    <input type="date" style="display:inline;" id="dataAbertura" name="dataAbertura" value="<?= date("Y-m-d"); ?>">
                    <br>
                    <label for="usuarioDemandante">Usuário demandante:</label>
                    <input type="text" id="usuarioDemandante" name="usuarioDemandante" placeholder="Qual o usuario demandante?">
                    <br>
                    <label for="dependencia">Dependencia:</label>
                    <select name="dependencia" id="dependencia">
                        <option value=""></option>
                        <?php
                            foreach ($dependencias as $dependencias): 
                                $id = $dependencias->getId();
                                $nome = $dependencias->getNome();
                                echo"<option value='$id'>$nome</option>";
                            endforeach;
                        ?>
                    </select>
                    <br>
                    <label for="descricao">Descrição:</label>
                    <br>
                    <textarea name="descricao" id="descricao" placeholder="Descrição da ordem de serviço" rows="5" style="width: 100%;"></textarea>
                    <input type="text" value="<?=$ordemNum+1?>" style="display: none;" name="numero">
                    <input type="text" value="<?=$anoAtual?>" style="display: none;" name="ano">
                    <br>
                    <br>
                    <hr>
                    <button type="submit" name="cadastro" class="btn btn-success">Cadastrar</button>
                    <button type="button" class="btn btn-danger" id="cancelarCadastro">Cancelar</button>
                </form>
                <br>
            </div>
        </div>
    </div>
    <?php 
      include "src/require/modalErro.php";
      include "src/require/modalSucesso.php";                 
    ?>
</body>
</html>