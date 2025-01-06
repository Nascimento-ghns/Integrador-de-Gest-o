<?php

    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/ordemSv.php";
    require "src/repositorio/ordemSvRepositorio.php";

    $ordemSvRepositorio = new ordemSvRepositorio($pdo);
    $ordemSv = $ordemSvRepositorio->buscarTodos();

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
            $("tbody tr").click(function(){
                var nomeTabela = jQuery(this).children("td:first").text();
                url= "editarOrdem2.php?nomeTabela=" + nomeTabela;
                location.href = url;
            })
        });
    </script>
</head>
<body>
    <div class="container-fluid" id="corpo">
        <?php require "src/require/navbarOrdem.php"; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 fundoDiv">
                <h1 class="centralizaTitulo">Edição de Ordem de Serviço</h1>
                <br>
                <table style="width: 100%;" class="table table-striped table-bordered table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th style="display: none;"></th>
                            <th class="text-center" width="10%">OSv</th>
                            <th class="text-center" width="80%">Descricao</th>
                            <th class="text-center" width="10%">Status</th>
                        </tr>
                        <tr>
                            <th style='display: none;'><input type='text' id='txtColuna1' width='15%'/></th>
                            <th width="%"><input type='text' id='txtColuna1'></th>
                            <th width="%"><input type='text' id='txtColuna2'></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ordemSv as $ordemSv): ?>
                            <tr>
                                <td style="display: none;"><?= $ordemSv->getNum() ?></td>
                                <td width="%">OSv<?= $ordemSv->getNum() ?></td>
                                <td width="%"><?= $ordemSv->getDescricao() ?></td>
                                <td class="text-center"><?=$ordemSv->getEstadoFinal()?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>