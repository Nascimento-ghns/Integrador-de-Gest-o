<?php
    if (isset($_POST['duplicar'])){
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
                <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th style="display: none;">Id</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Modelo</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-center">Fabricante</th>
                            <th class="text-center">Editar</th>
                            <th class="text-center">Exibir</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php foreach ($materiais as $material): ?>
                            <tr>
                                <td style="display: none;"><?= $material->getId() ?></td>
                                <td><?= $material->getNome() ?></td>
                                <td><?= $material->getModelo() ?></td>
                                <td class="text-center"><?= $material->getQuant() ?></td>
                                <td><?= $material->getFabricante() ?></td>
                                <td class="text-center"><button onClick="editar(<?= $material->getId() ?>)"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                <td class="text-center"><button onClick="exibir(<?= $material->getId() ?>)"><span class="glyphicon glyphicon-search"></span></button></td>
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