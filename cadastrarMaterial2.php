<?php

    if($_POST['prevAlocMat'] == ""){
        $prevAlocMat = null;
    }

    $dataInclusao = str_replace('/', '-', $_POST['dataInclusao']);
    $dataInclusaoConvertida = date('Y-m-d', strtotime($dataInclusao));
    $dataBaixa = str_replace('/', '-', $_POST['dataBaixa']);
    $dataBaixaConvertida = date('Y-m-d', strtotime($dataBaixa));
    $dataValorCotacao = str_replace('/', '-', $_POST['dataValorCotacao']);
    $dataValorCotacaoConvertida = date('Y-m-d', strtotime($dataValorCotacao));

    $material = new Material(null,
    $_POST['nome'],
    $_POST['descricao'],
    $_POST['fabricante'],
    $_POST['modelo'],
    $_POST['tipo'],
    $_POST['quantidade'],
    $dataInclusaoConvertida,
    $dataBaixaConvertida,
    $_POST['valorCarga'],
    $dataValorCotacaoConvertida,
    $_POST['valorCotacao'],
    $prevAlocMat,
    $_POST['catMat'],
    $_POST['numSerie']
    );

    $materialRepositorio = new materialRepositorio($pdo);
    $materialRepositorio->salvar($material);

?>