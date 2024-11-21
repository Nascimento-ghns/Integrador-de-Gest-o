<?php
    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/material.php";
    require "src/repositorio/materialRepositorio.php";
    require "src/modelo/dependencia.php";
    require "src/repositorio/dependenciaRepositorio.php";
    require "src/modelo/tipo.php";
    require "src/repositorio/tipoRepositorio.php";

    $dependenciaRepositorio = new dependenciaRepositorio($pdo);
    $dependencias = $dependenciaRepositorio->buscarTodos();
    
    $tipoRepositorio = new tipoRepositorio($pdo);
    $tipos = $tipoRepositorio->buscarTodos();

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
    <script src="bibliotecas/js/formCadMaterial.js" defer></script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrador de Gestão</title>

    <script type="text/javascript">

        $(document).ready(function(){
            
            $('#incMat').submit(function(evento){
                
                evento.preventDefault();
					
					if (validarDados()) {
						
						var dados = jQuery( this ).serialize();
						
						$.ajax({
							type: "POST",
							url: "cadastrarMaterial2.php",
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
        <?php require "src/require/navbarMaterial.php"; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 fundoDiv">
                <form method="post" id="incMat" class="fundoCinza form">
                    <h1 class="centralizaTitulo">Cadastro de Material</h1>
                    <hr>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" require placeholder="Nome do materail">
                    <br>
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" placeholder="digite a descricao">
                    <br>
                    <label for="fabricante">Fabricante:</label>
                    <input type="text" id="fabricante" name="fabricante" require placeholder="digite o fabricante">
                    <br>
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" require placeholder="digite o modelo">
                    <br>
                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo">
                        <option value=""></option>
                        <?php
                            foreach ($tipos as $tipos): 
                                $id = $tipos->getId();
                                $nome = $tipos->getNome();
                                echo"<option value='$id'>$nome</option>";
                            endforeach;
                        ?>
                    </select>
                    <br>
                    <label for="quantidade">Quantidade:</label>
                    <input type="text" id="quantidade" name="quantidade" require placeholder="digite a quantidade">
                    <br>
                    <label for="dataInclusao">Data de inclusão:</label>
                    <input type="date" id="dataInclusao" name="dataInclusao" placeholder="data de inclusao">
                    <br>
                    <label for="dataBaixa">Data de baixa:</label>
                    <input type="date" id="dataBaixa" name="dataBaixa" placeholder="data de baixa">
                    <br>
                    <label for="valorCarga">Valor Carga:</label>
                    <input type="text" id="valorCarga" name="valorCarga" placeholder="digite o valor carga">
                    <br>
                    <label for="dataValorCotacao">Data valor cotação:</label>
                    <input type="date" id="dataValorCotacao" name="dataValorCotacao" placeholder="digite a data calor cotacao">
                    <br>
                    <label for="valorCotacao">Valor cotação:</label>
                    <input type="text" id="valorCotacao" name="valorCotacao" placeholder="digite o valor cotacao">
                    <br>
                    <label for="prevAlocMat">Previsão de alocação do material:</label>
                    <select name="prevAlocMat" id="prevAlocMat">
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
                    <label for="catMat">CATMAT:</label>
                    <input type="text" id="catMat" name="catMat" placeholder="categoria do material">
                    <br>
                    <label for="numSerie">Numero de série:</label>
                    <input type="text" id="numSerie" name="numSerie" placeholder="digite o numero de serie">
                    <br>
                    <br>
                    <hr>
                    <button type="submit" name="cadastro" class="btn btn-success">Cadastrar</button>
                    <button type="button" class="btn btn-danger" id="cancelarCadastro">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
    <?php 
      include "src/require/modalErro.php";
      include "src/require/modalSucesso.php";                 
    ?>
</body>
</html>