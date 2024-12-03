<?php

    $ordemNum = $_GET['nomeTabela'];
    if(isset($_POST['addTecnico']) or isset($_POST['addEquipamentoAfetado'])){
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

    $dependenciaRepositorio = new dependenciaRepositorio($pdo);
    $dependencia = $dependenciaRepositorio->buscar($ordemSv->getDependencia()); 

    $tecnicosRepositorio = new tecnicoRepositorio($pdo);
    $tecnicos = $tecnicosRepositorio->buscarTodos(); 

    $OSvRepositorio = new OSvRepositorio($pdo);
    $OSvs = $OSvRepositorio->buscarTodos($ordemNum);

    $materialRepositorio = new materialRepositorio($pdo);
    $material = $materialRepositorio->buscarDependencia($ordemSv->getDependencia());

    $anoAtual = date('Y');

    if(isset($_POST['addTecnico'])){
        $OSv = new OSv(null, $_POST['tecnicos'], null, null, null, null, null, null, null);
        $OSvRepositorio->salvarTecnico($OSv, $ordemNum);
    }

    if(isset($_POST['addEquipamentoAfetado'])){
        $OSv = new OSv(null, null, $_POST['equipamentoAfetado'], null, null, null, null, null, null);
        $OSvRepositorio->salvarEquipamentoAfetado($OSv, $ordemNum);
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
        function excluirTecnico(nomeTecnico){
            console.log(1);
            
        }
        $(document).ready(function(){
            
        });
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
                                        <?php foreach ($tecnicos as $tecnicos): ?>
                                            <option value="<?=$tecnicos->getNome()?>"><?=$tecnicos->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" name="addTecnico"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
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
                                            <td width="" class="text-center"><button onClick="excluirTecnico(<?= $OSvs->getTecnicos() ?>)"><span class="glyphicon glyphicon-trash"></span></button></td>
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
                            <input type="date" name="dataInicio">
                            <label for="">Hora de início:</label>
                            <input type="time" name="horaInicio">
                            <label for="">Data de fim:</label>
                            <input type="date" name="dataFim">
                            <label for="">Hora de fim:</label>
                            <input type="time" name="horaFim">
                            <label for="">Hh:</label>
                            <input type="text" name="Hh">
                            <label for="">Dias até iniciar OSv:</label>
                            <input type="text" name="diasAteInicio">
                            <label for="">Dias de trabalho OSv:</label>
                            <input type="text" name="diasTrabalhados">
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
                                    <button class="adiciona" name="addEquipamentoAfetado"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 100%;">Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $OSvs = $OSvRepositorio->buscarTodos($ordemNum); foreach ($OSvs as $OSvs): 
                                        if($OSvs->getEquipamentosAfetados() != null){?>
                                        
                                        <tr>
                                            <td style="display: none;"></td>
                                            <td><?=$OSvs->getEquipamentosAfetados()?></td>
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
                                            $material = $materialRepositorio->buscarMaterial(5);
                                            foreach ($material as $material): ?>
                                                <option value="<?=$material->getNome()?>"><?=$material->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona" name="addMatConsumo"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 100%;">Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="display: none;"></td>
                                        <td>Placa de Vídeo</td>
                                    </tr>
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
                                    <select name="tecnicos" id="">
                                        <option value=""></option>
                                        <?php foreach ($tecnicos as $tecnicos): ?>
                                            <option value="<?=$tecnicos->getId()?>"><?=$tecnicos->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 100%;">Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="display: none;"></td>
                                        <td>Placa de Vídeo</td>
                                    </tr>
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
                                    <select name="tecnicos" id="">
                                        <option value=""></option>
                                        <?php foreach ($tecnicos as $tecnicos): ?>
                                            <option value="<?=$tecnicos->getId()?>"><?=$tecnicos->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 100%;">Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="display: none;"></td>
                                        <td>Placa de Vídeo</td>
                                    </tr>
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
                                    <select name="tecnicos" id="">
                                        <option value=""></option>
                                        <?php foreach ($tecnicos as $tecnicos): ?>
                                            <option value="<?=$tecnicos->getId()?>"><?=$tecnicos->getNome()?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <button class="adiciona"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                </div>
                            </div>
                            <br>
                            <table style="width: 100%;" class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark" >
                                    <tr style="width: 100%;">
                                        <th style="display: none;"></th>
                                        <th class="text-center" style="width: 100%;">Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="display: none;"></td>
                                        <td>Placa de Vídeo</td>
                                    </tr>
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
            </div>
        </div>
</body>
</html>