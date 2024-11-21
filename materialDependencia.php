<?php

    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/material.php";
    require "src/repositorio/materialRepositorio.php";
    require "src/modelo/dependencia.php";
    require "src/repositorio/dependenciaRepositorio.php";
    
    $dependenciaRepositorio = new dependenciaRepositorio($pdo);
    $dependencias = $dependenciaRepositorio->buscarTodos();
    
    if(isset($_POST['dependencias'])){
        $radio = "<input type='radio' class='radio' id='porDep' name='dep' value='1' checked><label for='porDep'>Por dependência</label><input type='radio' class='radio' id='todasDep' name='dep' value='2'><label for='todasDep'>Todas dependências</label>";
        $mostra = "$('#A').show();$('#B').hide();console.log(1)";
    }
    else{
        $radio = "<input type='radio' class='radio' id='porDep' name='dep' value='1'><label for='porDep'>Por dependência</label><input type='radio' class='radio' id='todasDep' name='dep' value='2'><label for='todasDep'>Todas dependências</label>";
        $mostra = null;
    }

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
        
        $(document).ready(function(){
            $('#mudaPagina').change(function() {
                if ($('#porDep').prop('checked')) {
                    $('#A').show();
                    $('#B').hide();
                } else {
                    $('#B').show();
                    $('#A').hide();
                }
            });
            <?= $mostra; ?>
        });
    </script>
</head>
<body>
    <div class="container-fluid" id="corpo">
        <?php require "src/require/navbarMaterial.php"; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 fundoDiv">
                <form id="mudaPagina" method="post">
                    <?= $radio; ?>
                </form>
                <div id="A" style="display: none;">
                    <?php  include "materialDepSelect.php"; ?>
                </div>
                <div id="B" style="display: none;">
                    <?php  include "materialTodasDep.php"; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>