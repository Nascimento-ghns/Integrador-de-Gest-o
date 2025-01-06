<?php
    
    require "src/require/acesso.php";
    require "src/conexaoBD.php";
    require "src/modelo/ordemSv.php";
    require "src/repositorio/ordemSvRepositorio.php";
    require "src/modelo/OSv.php";
    require "src/repositorio/OSvRepositorio.php";

    $ordemNum = $_POST['ordemNum'];

    $ordemSvRepositorio = new ordemSvRepositorio($pdo);
    $ordemSv = $ordemSvRepositorio->buscarPorNumero($ordemNum);
    $ordemSvRepositorio->finalizarOrdem($ordemNum, $ordemSv->getDataInicio(), $ordemSv->getDataInicioMnt());
    $ordemSvRepositorio->salvarDataTermino($ordemNum, $ordemSv->getDataInicio(), $ordemSv->getDataTermino());
    $ordemSvRepositorio->salvarDataFimMnt($ordemNum, $ordemSv->getDataFimMnt());



?>