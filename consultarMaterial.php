<?php
    if (isset($_POST['duplicar']) or isset($_POST['editar']) or isset($_POST['excluir'])){
        header('location:http://localhost/IntegradorDeGest%C3%A3o/redirecionaDuplicar.php');
    }
    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/material.php";
    require "src/repositorio/materialRepositorio.php";

    $materialRepositorio = new materialRepositorio($pdo);
    $materiais = $materialRepositorio->buscarTodos();

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
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrador de Gestão</title>

    <script type="text/javascript">

        function editar(idMaterial){
            $.ajax({
                type: "post",
                data: "matId=" + idMaterial,
                url: "editarMaterial2.php",
                success: function( resposta )
                {
                    $("#modalTextoAlt").html( resposta );
                    $("#modalAltTitulo").text("Alteração de Material");
                    $("#janelaModalAlt").modal();
                }
            });
        }
        function exibir(idMaterial){
            $.ajax({
                type: "post",
                data: "matId=" + idMaterial,
                url: "consultarMaterial2.php",
                success: function( resposta )
                {
                    $("#modalTextoInfo").html( resposta );
                    $("#modalInfoTitulo").text("Consulta de Material");
                    $("#janelaModalInfo").modal();
                }
            });
        }
        function confirmaAlterar(){
            document.getElementById("confirmarAlterar").style.display = 'block';
        }
        function confirmaDuplicar(){
            document.getElementById("confirmarDuplicar").style.display = 'block';
        }
        function confirmaExcluir(){
            document.getElementById("confirmarExcluir").style.display = 'block';
        }
        $(function(){
            $(".table-responsive input").keyup(function(){       
                var index = $(this).parent().index();
                var nth = ".table-responsive td:nth-child("+(index+1).toString()+")";
                var valor = $(this).val().toUpperCase();
                $(".table-responsive tbody tr").show();
                $(nth).each(function(){
                    if($(this).text().toUpperCase().indexOf(valor) < 0){
                        $(this).parent().hide();
                    }
                });
            });
            
            $(".table-responsive input").blur(function(){
                $(this).val("");
            });
            
        });
        $(document).ready(function(){
            
        });
    </script>
    
</head>
<body>
    <div class="container-fluid" id="corpo">
        <?php require "src/require/navbarMaterial.php"; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 fundoDiv">
                <br>
                <h1 class="centralizaTitulo">Consulta de Material</h1>
                <br>
                <table style="width: 100%;" class="table table-striped table-bordered table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th style="display: none;">Id</th>
                            <th class="text-center" width="50%">Nome</th>
                            <th class="text-center" width="15%">Modelo</th>
                            <th class="text-center" width="5%">Quantidade</th>
                            <th class="text-center" width="10%">Fabricante</th>
                            <th class="text-center" width="10%">Editar</th>
                            <th class="text-center" width="10%">Exibir</th>
                        </tr>
                        <tr>
                            <th style='display: none;'><input type='text' id='txtColuna1' width='15%'/></th>
                            <th width="%"><input type='text' id='txtColuna1'></th>
                            <th width="%"><input type='text' id='txtColuna2'></th>
                            <th width="%"><input type='text' id='txtColuna3'></th>
                            <th width="%"><input type='text' id='txtColuna4'></th>
                            <th width="%"></th>
                            <th width="%"></th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php foreach ($materiais as $material): ?>
                            <tr>
                                <td style="display: none;"><?= $material->getId() ?></td>
                                <td width="%"><?= $material->getNome() ?></td>
                                <td width="%"><?= $material->getModelo() ?></td>
                                <td width="%" class="text-center"><?= $material->getQuant() ?></td>
                                <td width="%"><?= $material->getFabricante() ?></td>
                                <td width="%" class="text-center"><button onClick="editar(<?= $material->getId() ?>)"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                <td width="%" class="text-center"><button onClick="exibir(<?= $material->getId() ?>)"><span class="glyphicon glyphicon-search"></span></button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php 
        include "src/require/modalInfo.php";
        include "src/require/modalAlt.php";                    
    ?>
</body>
</html>