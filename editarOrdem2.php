<?php

    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/ordemSv.php";
    require "src/repositorio/ordemSvRepositorio.php";
    require "src/modelo/dependencia.php";
    require "src/repositorio/dependenciaRepositorio.php";
    require "src/modelo/tecnicos.php";
    require "src/repositorio/tecnicosRepositorio.php";

    $ordemNum = $_GET['nomeTabela'];
    $ordemSvRepositorio = new ordemSvRepositorio($pdo);
    $ordemSv = $ordemSvRepositorio->buscarPorNumero($ordemNum);

    $dependenciaRepositorio = new dependenciaRepositorio($pdo);
    $dependencia = $dependenciaRepositorio->buscar($ordemSv->getDependencia()); 

    $tecnicosRepositorio = new tecnicoRepositorio($pdo);
    $tecnicos = $tecnicosRepositorio->buscarTodos(); 
    
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
            
        });
    </script>
</head>
<body>
    <div class="container-fluid" id="corpo">
        <?php require "src/require/navbarOrdem.php"; ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 fundoDiv">
                <div class="row"><div class="col-12 centralizaTitulo"><h1>Edição de Ordem de Serviço Nº<?=$anoAtual;?>/<?=str_pad($ordemNum , 4 , '0' , STR_PAD_LEFT);?></h1></div></div>
                <div class="row">
                    <div class="col-6">
                        <form class="fundoCinza form">
                            <label for="dataAbertura">Data de abertura:</label>
                            <input type="date" style="display:inline;" id="dataAbertura" name="dataAbertura" disabled value="<?=$ordemSv->getDataInicio()?>">
                            <br>
                            <label for="usuarioDemandante">Usuário demandante:</label>
                            <input type="text" id="usuarioDemandante" name="usuarioDemandante" disabled value="<?=$ordemSv->getAutor()?>">
                            <br>
                            <label for="dependencia">Dependencia:</label>
                            <select name="dependencia" disabled id="dependencia">
                                <option value=""><?=$dependencia->getNome();?></option>
                            </select>
                            <br>
                            <label for="descricao">Descrição:</label>
                            <br>
                            <textarea name="descricao" id="descricao" disabled rows="5" style="width: 100%;"><?=$ordemSv->getDescricao()?></textarea>
                            <br>
                        </form>
                    </div>
                    <div class="col-3">
                        <form action="" class="fundoCinza form" method="post">
                            <label for="tecnicos">Selecione os tecnicos:</label>
                            <select name="tecnicos" id="">
                                <option value=""></option>
                                <?php foreach ($tecnicos as $tecnicos): ?>
                                    <option value="<?=$tecnicos->getId()?>"><?=$tecnicos->getNome()?></option>
                                <?php endforeach; ?>
                            </select>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover table-responsive">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 100%;">Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="display: none;"></td>
                                        <td >Ordem N</td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-3">
                        
                    </div>
                </div>
            </div>
        </div>
</body>
</html>