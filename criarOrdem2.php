<?php
    
    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/ordemSv.php";
    require "src/repositorio/ordemSvRepositorio.php";

    $dataAbertura = str_replace('/', '-', $_POST['dataAbertura']);
    $dataAberturaConvertida = date('Y-m-d', strtotime($dataAbertura));

    $ordemSv = new OrdemSv(null,
    $_POST['usuarioDemandante'],
    $dataAberturaConvertida,
    null,
    null,
    $_POST['descricao'],
    $_POST['dependencia'],
    $_POST['numero'],
    $_POST['ano']
    );

    $ordemSvRepositorio = new ordemSvRepositorio($pdo);
    $ordemSvRepositorio->salvar($ordemSv);

?>