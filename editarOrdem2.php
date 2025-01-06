<?php

    $ordemNum = $_GET['nomeTabela'];

    if(isset($_POST['addTecnico']) or isset($_POST['addEquipamentoAfetado']) or isset($_POST['excluirEquipamentoAfetado']) or isset($_POST['excluirTecnico']) or isset($_POST['addMatConsumo']) or isset($_POST['addMatConsumoDuravel']) or isset($_POST['addMatPermanente']) or isset($_POST['addMatPermanenteRemovido']) or isset($_POST['excluirMatConsumo']) or isset($_POST['excluirMatConsumoDuravel']) or isset($_POST['excluirMatPermanente']) or isset($_POST['excluirMatPermanenteRemovido']) or isset($_POST['finalizarOS']) or isset($_POST['excluirOS'])){
        header("Location:http://localhost/IntegradorDeGest%C3%A3o/redirecionaOrdem.php?nomeTabela=$ordemNum");  
    }

    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/ordemSv.php";
    require "src/repositorio/ordemSvRepositorio.php";
    require "src/modelo/dependencia.php";
    require "src/repositorio/dependenciaRepositorio.php";
    require "src/modelo/tecnicos.php";
    require "src/repositorio/tecnicosRepositorio.php";
    require "src/modelo/OSv.php";
    require "src/repositorio/OSvRepositorio.php";
    require "src/modelo/material.php";
    require "src/repositorio/materialRepositorio.php";
    
    $ordemSvRepositorio = new ordemSvRepositorio($pdo);
    $ordemSv = $ordemSvRepositorio->buscarPorNumero($ordemNum);
    if($ordemSv->getEstadoFinal() == 'aberto'){
        $display = '';
    } 
    else{
        $display = 'disabled';
    }
    if($ordemSv->getDataInicioMnt() == null){
        $ordemSvRepositorio->salvarDataInicioMnt($ordemNum);
        $ordemSv = $ordemSvRepositorio->buscarPorNumero($ordemNum);
        $ordemSvRepositorio->calculaDiasAteIniciar($ordemSv);
    }
    if($ordemSv->getHoraInicioMnt() == null){
        $timezone = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $timezone);
        $ordemSvRepositorio->salvarHoraInicioMnt($ordemNum, $agora);
    }

    $dependenciaRepositorio = new dependenciaRepositorio($pdo);
    $dependencia = $dependenciaRepositorio->buscar($ordemSv->getDependencia()); 

    $materialRepositorio = new materialRepositorio($pdo);
    $material = $materialRepositorio->buscarDependencia($ordemSv->getDependencia());

    $tecnicosRepositorio = new tecnicoRepositorio($pdo);
    $tecnicos = $tecnicosRepositorio->buscarDisponiveis($ordemNum); 

    $OSvRepositorio = new OSvRepositorio($pdo);
    $OSvs = $OSvRepositorio->buscarTodos($ordemNum);

   

    $anoAtual = date('Y');

    if(isset($_POST['addTecnico'])){
        $OSv = new OSv(null, $_POST['tecnicos'], null, null, null, null, null, null, null);
        $OSvRepositorio->salvarTecnico($OSv, $ordemNum);
    }

    if(isset($_POST['addEquipamentoAfetado'])){
        $OSv = new OSv(null, null, $_POST['equipamentoAfetado'], null, null, null, null, null, null);
        $OSvRepositorio->salvarEquipamentoAfetado($OSv, $ordemNum);
    }

    if(isset($_POST['addMatConsumo'])){
        $OSv = new OSv(null, null, null, $_POST['matConsumo'], null, null, null, null, null);
        $OSvRepositorio->salvarMaterialConsumo($OSv, $ordemNum);
    }

    if(isset($_POST['addMatConsumoDuravel'])){
        $OSv = new OSv(null, null, null, null, $_POST['matConsumoDuravel'], null, null, null, null);
        $OSvRepositorio->salvarMaterialConsumoDuravel($OSv, $ordemNum);
    }

    if(isset($_POST['addMatPermanente'])){
        $OSv = new OSv(null, null, null, null, null, $_POST['matPermanente'], null, null, null);
        $OSvRepositorio->salvarMaterialPermanente($OSv, $ordemNum);
    }

    if(isset($_POST['addMatPermanenteRemovido'])){
        $OSv = new OSv(null, null, null, null, null, null, $_POST['matPermanenteRemovido'], null, null);
        $OSvRepositorio->salvarMaterialPermanenteRemovido($OSv, $ordemNum);
    }
    
    if(isset($_POST['excluirTecnico'])){
        $OSvRepositorio->excluirTecnico($_POST['excluirTecnico'], $ordemNum);
    }

    if(isset($_POST['excluirEquipamentoAfetado'])){
        $OSvRepositorio->excluirEquipamentoAfetado($_POST['excluirEquipamentoAfetado'], $ordemNum);
    }

    if(isset($_POST['excluirMatConsumo'])){
        $OSvRepositorio->excluirMatConsumo($_POST['excluirMatConsumo'], $ordemNum);
    }

    if(isset($_POST['excluirMatConsumoDuravel'])){
        $OSvRepositorio->excluirMatConsumoDuravel($_POST['excluirMatConsumoDuravel'], $ordemNum);
    }

    if(isset($_POST['excluirMatPermanente'])){
        $OSvRepositorio->excluirMatPermanente($_POST['excluirMatPermanente'], $ordemNum);
    }

    if(isset($_POST['excluirMatPermanenteRemovido'])){
        $OSvRepositorio->excluirMatPermanenteRemovido($_POST['excluirMatPermanenteRemovido'], $ordemNum);
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
    <script src="bibliotecas/js/formCadOrdem.js" defer></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integrador de Gestão</title>
    <script type="text/javascript">

        $(document).ready(function(){

            $("#btnFim").click(function(evento){
                $.ajax({
                    type: "post",
                    data: "ordemNum=" + ordemNum,
                    url: "finalizarOrdem.php",
                    success: function( resposta ) {
                        if (resposta.indexOf("Erro") != -1 ) {
                            $("#modalErroTitulo").html('Erro');
                            $("#modalErro").html( resposta );
                            $("#janelaModalErro").modal();
                        }
                        else {
                            $("#modalTextoTitulo").text("OS finalizada");
                            $("#modalTexto").html( resposta );
                            $("#janelaModal").modal();
                        }
                    }
                });	
                $(location).attr('href', 'http://localhost/IntegradorDeGest%C3%A3o/editarOrdem.php');
            })

            $("#btnExcluir").click(function(evento){
                $.ajax({
                    type: "post",
                    data: "ordemNum=" + ordemNum,
                    url: "excOrdem.php",
                    success: function( resposta ) {
                        if (resposta.indexOf("Erro") != -1 ) {
                            $("#modalErroTitulo").html('Erro de Exclusão');
                            $("#modalErro").html( resposta );
                            $("#janelaModalErro").modal();
                        }
                        else {
                            $("#modalTextoTitulo").text("Exclusão bem sucedida");
                            $("#modalTexto").html( resposta );
                            $("#janelaModal").modal();
                        }
                    }
                });	
                $(location).attr('href', 'http://localhost/IntegradorDeGest%C3%A3o/editarOrdem.php');
            })
            
        });

        var ordemNum = "<?=$ordemNum?>";

        function excluirOS(){
            var nome = "OSv<?=$ordemNum?>";
            $("#modalExcTexto").html( "Deseja realmente excluir definitivamente as informações de <b>"+nome+"</b>?");
            $("#modalExcTitulo").text("ATENÇÃO: Exclusão Definitiva de OS");
            $("#janelaModalExclusao").modal();
        }

        function finalizarOS(){
            var nome = "OSv<?=$ordemNum?>";
            $("#modalFimTexto").html( "Deseja realmente finalizar definitivamente as informações de <b>"+nome+"</b>?");
            $("#modalFimTitulo").text("ATENÇÃO: Finalização Definitiva de OS");
            $("#janelaModalFim").modal();
        }

        function voltar(){
            $(location).attr('href', 'http://localhost/IntegradorDeGest%C3%A3o/editarOrdem.php');
        }

    </script>
</head>
<body>
    <div class="container-fluid" id="corpo">
        <?php require "src/require/navbarOrdem.php"; ?>
        <div class="row">
            <div class="col-md-10 offset-md-1 fundoDiv">
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
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Tecnicos</h3>
                            <label for="tecnicos">Selecione os tecnicos:</label>
                            <div class="row">
                                <div class="col-10">
                                    <select name="tecnicos" id="">
                                        <option value=""></option>
                                        <?php $tecnicos = $tecnicosRepositorio->buscarTodos(); foreach ($tecnicos as $tecnicos): ?>
                                            <option value="<?=$tecnicos->getNome()?>"><?=$tecnicos->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" name="addTecnico" <?=$display?>><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 100%;">Nome</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($OSvs as $OSvs): 
                                        if($OSvs->getTecnicos() != null){?>
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td><?=$OSvs->getTecnicos()?></td>
                                            <td width="" class="text-center"><button type="submit" <?=$display?> name="excluirTecnico" value="<?=$OSvs->getTecnicos()?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                        </tr>
                                    <?php } endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-3">
                        <form action="" class="fundoCinza form" method="post">
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Métricas de trabalho</h3>
                            <label for="">Data de início:</label>
                            <input type="date" name="dataInicio"  value="<?=$ordemSv->getDataInicioMnt()?>">
                            <label for="">Hora de início:</label>
                            <input type="time" name="horaInicio"  value="<?=$ordemSv->getHoraInicioMnt()?>">
                            <label for="">Data de fim:</label>
                            <input type="date" name="dataFim"  value="<?=$ordemSv->getDataFimMnt()?>">
                            <label for="">Hora de fim:</label>
                            <input type="time" name="horaFim"  value="<?=$ordemSv->getHoraFimMnt()?>">
                            <label for="">Hh:</label>
                            <input type="text" name="Hh"  value="<?=$ordemSv->getHomemHora()?>">
                            <label for="">Dias até iniciar OSv:</label>
                            <input type="text" name="diasAteInicio"  value="<?=$ordemSv->getDiasAteIniciar()?>">
                            <label for="">Dias de trabalho OSv:</label>
                            <input type="text" name="diasTrabalhados"  value="<?=$ordemSv->getDiasTrabalhados()?>">
                            <br>
                            <br>
                            <button name="atualizarMetricas" type="submit" <?=$display?> class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <form action="" class="fundoCinza form" method="post">
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Equipamentos afetados</h3>   
                            <label for="equipamentoAfetado">Selecione os equipamentos que sofreram reparos:</label>
                            <div class="row">
                                <div class="col-10">
                                    <select name="equipamentoAfetado" id="">
                                        <option value=""></option>
                                        <?php foreach ($material as $material): ?>
                                            <option value="<?=$material->getId()?>"><?=$material->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" <?=$display?> name="addEquipamentoAfetado"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 23%;">Nome</th>
                                        <th class="text-center" style="width: 23%;">Fabricante</th>
                                        <th class="text-center" style="width: 23%;">Modelo</th>
                                        <th class="text-center" style="width: 23%;">N/S</th>
                                        <th style="width: 8%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $OSvs = $OSvRepositorio->buscarTodos($ordemNum); foreach ($OSvs as $OSvs): 
                                        if($OSvs->getEquipamentosAfetados() != null){?>
                                        <tr>
                                            <?php $material = $materialRepositorio->buscar($OSvs->getEquipamentosAfetados()); ?>
                                            <td style="display: none;"><?=$material->getId()?></td>
                                            <td><?=$material->getNome()?></td>
                                            <td><?=$material->getFabricante()?></td>
                                            <td><?=$material->getModelo()?></td>
                                            <td><?=$material->getNumSerie()?></td>
                                            <td width="" class="text-center"><button <?=$display?> type="submit" name="excluirEquipamentoAfetado" value="<?=$material->getId()?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                        </tr>
                                    <?php } endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="" class="fundoCinza form" method="post">
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Material de consumo empregado</h3>
                            <label for="matConsumo">Selecione os materiais:</label>
                            <div class="row">
                                <div class="col-10">
                                    <select name="matConsumo" id="">
                                        <option value=""></option>
                                        <?php 
                                            $materialConsumo = $materialRepositorio->buscarMaterial(5);
                                            foreach ($materialConsumo as $material): ?>
                                                <option value="<?=$material->getId()?>"><?=$material->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" <?=$display?> name="addMatConsumo"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 25%;">Nome</th>
                                        <th class="text-center" style="width: 25%;">Fabricante</th>
                                        <th class="text-center" style="width: 25%;">Modelo</th>
                                        <th class="text-center" style="width: 25%;">N/S</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $OSvs = $OSvRepositorio->buscarTodos($ordemNum); foreach ($OSvs as $OSvs): 
                                        if($OSvs->getMatConsumo() != null){?>
                                        <tr>
                                            <?php $material = $materialRepositorio->buscar($OSvs->getMatConsumo()); ?>
                                            <td style="display: none;"><?=$material->getId()?></td>
                                            <td><?=$material->getNome()?></td>
                                            <td><?=$material->getFabricante()?></td>
                                            <td><?=$material->getModelo()?></td>
                                            <td><?=$material->getNumSerie()?></td>
                                            <td width="" class="text-center"><button <?=$display?> type="submit" name="excluirMatConsumo" value="<?=$material->getId()?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                        </tr>
                                    <?php } endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <form action="" class="fundoCinza form" method="post">
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Material de consumo duravel empregado</h3>   
                            <label for="tecnicos">Selecione os materiais:</label>
                            <div class="row">
                                <div class="col-10">
                                    <select name="matConsumoDuravel" id="">
                                        <option value=""></option>
                                        <?php 
                                            $materialConsumoDuravel = $materialRepositorio->buscarMaterial(11);
                                            foreach ($materialConsumoDuravel as $material): ?>
                                                <option value="<?=$material->getId()?>"><?=$material->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" <?=$display?> name="addMatConsumoDuravel"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 25%;">Nome</th>
                                        <th class="text-center" style="width: 25%;">Fabricante</th>
                                        <th class="text-center" style="width: 25%;">Modelo</th>
                                        <th class="text-center" style="width: 25%;">N/S</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $OSvs = $OSvRepositorio->buscarTodos($ordemNum); foreach ($OSvs as $OSvs): 
                                        if($OSvs->getMatConsumoDuravel() != null){?>
                                        <tr>
                                            <?php $material = $materialRepositorio->buscar($OSvs->getMatConsumoDuravel()); ?>
                                            <td style="display: none;"><?=$material->getId()?></td>
                                            <td><?=$material->getNome()?></td>
                                            <td><?=$material->getFabricante()?></td>
                                            <td><?=$material->getModelo()?></td>
                                            <td><?=$material->getNumSerie()?></td>
                                            <td width="" class="text-center"><button <?=$display?> type="submit" name="excluirMatConsumoDuravel" value="<?=$material->getId()?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                        </tr>
                                    <?php } endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="" class="fundoCinza form" method="post">
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Material permanente empregado</h3>
                            <label for="tecnicos">Selecione os materiais:</label>
                            <div class="row">
                                <div class="col-10">
                                    <select name="matPermanente" id="">
                                        <option value=""></option>
                                        <?php 
                                            $materialPermanente = $materialRepositorio->buscarMaterial(12);
                                            foreach ($materialPermanente as $material): ?>
                                                <option value="<?=$material->getId()?>"><?=$material->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" <?=$display?> name="addMatPermanente"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 25%;">Nome</th>
                                        <th class="text-center" style="width: 25%;">Fabricante</th>
                                        <th class="text-center" style="width: 25%;">Modelo</th>
                                        <th class="text-center" style="width: 25%;">N/S</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $OSvs = $OSvRepositorio->buscarTodos($ordemNum); foreach ($OSvs as $OSvs): 
                                        if($OSvs->getMatPermanente() != null){?>
                                        <tr>
                                            <?php $material = $materialRepositorio->buscar($OSvs->getMatPermanente()); ?>
                                            <td style="display: none;"><?=$material->getId()?></td>
                                            <td><?=$material->getNome()?></td>
                                            <td><?=$material->getFabricante()?></td>
                                            <td><?=$material->getModelo()?></td>
                                            <td><?=$material->getNumSerie()?></td>
                                            <td width="" class="text-center"><button type="submit" <?=$display?> name="excluirMatPermanente" value="<?=$material->getId()?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                        </tr>
                                    <?php } endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <form action="" class="fundoCinza form" method="post">
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Material permanente removido</h3>   
                            <label for="tecnicos">Selecione os materiais:</label>
                            <div class="row">
                                <div class="col-10">
                                    <select name="matPermanenteRemovido" id="">
                                        <option value=""></option>
                                        <?php 
                                            $materialPermanente = $materialRepositorio->buscarMaterial(12);
                                            foreach ($materialPermanente as $material): ?>
                                                <option value="<?=$material->getId()?>"><?=$material->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" <?=$display?> name="addMatPermanenteRemovido"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 25%;">Nome</th>
                                        <th class="text-center" style="width: 25%;">Fabricante</th>
                                        <th class="text-center" style="width: 25%;">Modelo</th>
                                        <th class="text-center" style="width: 25%;">N/S</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $OSvs = $OSvRepositorio->buscarTodos($ordemNum); foreach ($OSvs as $OSvs): 
                                        if($OSvs->getMatPermanenteRemovido() != null){?>
                                        <tr>
                                            <?php $material = $materialRepositorio->buscar($OSvs->getMatPermanenteRemovido()); ?>
                                            <td style="display: none;"><?=$material->getId()?></td>
                                            <td><?=$material->getNome()?></td>
                                            <td><?=$material->getFabricante()?></td>
                                            <td><?=$material->getModelo()?></td>
                                            <td><?=$material->getNumSerie()?></td>
                                            <td width="" class="text-center"><button type="submit" <?=$display?> name="excluirMatPermanenteRemovido" value="<?=$material->getId()?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                        </tr>
                                    <?php } endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="" class="fundoCinza form" method="post">
                            <h3 class="centralizaTitulo" style="margin-top: 0;">Pedido de material</h3>   
                            <label for="tecnicos">Escreva os materiais:</label>
                            <br>
                            <textarea name="pedidoMat" id="" rows="6" style="width: 100%;"></textarea>
                            <br>
                        </form>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 text-right">
                        <button onClick="finalizarOS()" <?=$display?> class="btn btn-success">Finalizar</button>
                        <button onClick="excluirOS()" class="btn btn-danger">Excluir</button>
                        <button onClick="voltar()" name="voltar" class="btn btn-warning">Voltar</button>                
                    </div>
                </div>
                <br>
            </div>
        </div>
        <?php
            include "src/require/modalExclusao.php";
            include "src/require/modalFimOS.php";
        ?>
</body>
</html>