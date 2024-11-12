<?php
    
    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/material.php";
    require "src/repositorio/materialRepositorio.php";

    $dataInclusao = str_replace('/', '-', $_POST['dataInclusao']);
    $dataInclusaoConvertida = date('Y-m-d', strtotime($dataInclusao));
    $dataBaixa = str_replace('/', '-', $_POST['dataBaixa']);
    $dataBaixaConvertida = date('Y-m-d', strtotime($dataBaixa));
    $dataValorCotacao = str_replace('/', '-', $_POST['dataValorCotacao']);
    $dataValorCotacaoConvertida = date('Y-m-d', strtotime($dataValorCotacao));

    $valorCarga = $_POST['valorCarga'];
    if($valorCarga == ""){
        $valorCarga = null;
    }
    $valorCotacao = $_POST['valorCotacao'];
    if($valorCotacao == ""){
        $valorCotacao = null;
    }

    $material = new Material(null,
    $_POST['nome'],
    $_POST['descricao'],
    $_POST['fabricante'],
    $_POST['modelo'],
    $_POST['tipo'],
    $_POST['quantidade'],
    $dataInclusaoConvertida,
    $dataBaixaConvertida,
    $valorCarga,
    $dataValorCotacaoConvertida,
    $valorCotacao,
    $_POST['prevAlocMat'],
    $_POST['catMat'],
    $_POST['numSerie']
    );

    $materialRepositorio = new materialRepositorio($pdo);
    $materialRepositorio->salvar($material);

?>