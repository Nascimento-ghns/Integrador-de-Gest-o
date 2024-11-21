<?php require "src/require/acesso.php"; ?>
<!DOCTYPE html>
<html lang="pt-br"> 
<head>
<title>Consulta Completa</title>

<meta charset="utf-8">
 
</head>
<body>
<?php
	
	$matId = $_POST['matId'];
	
    require "src/conexaoBD.php";
    require "src/modelo/material.php";
    require "src/repositorio/materialRepositorio.php";
    require "src/modelo/dependencia.php";
    require "src/repositorio/dependenciaRepositorio.php";
    require "src/modelo/tipo.php";
    require "src/repositorio/tipoRepositorio.php";

    $materialRepositorio = new materialRepositorio($pdo);
	$material = $materialRepositorio->buscar($matId);

    $nome = $material->getNome();
    $descricao = $material->getDescricao();
    $fabricante = $material->getFabricante();
    $modelo = $material->getModelo();
    $tipo = $material->getTipo();
    $quant = $material->getQuant();
    $dataInclusao = $material->getDataInclusao();
    $dataBaixa = $material->getDataBaixa();
    $valorCarga = $material->getValorCarga();
    $dataValorCotacao = $material->getDataValorCotacao();
    $valorCotacao = $material->getValorCotacao();
    $prevAlocMat = $material->getPrevAlocDep();
    $catMat = $material->getCatMat();
    $numSerie = $material->getNumSerie();

    $dependenciaRepositorio = new dependenciaRepositorio($pdo);
    if($prevAlocMat == null or $prevAlocMat == 0){
      $depNomeSelect = "";
    }
    else{
      $dependenciaAtual = $dependenciaRepositorio->buscar($prevAlocMat);
      $depNomeSelect = $dependenciaAtual->getNome();
    }
    

    $tipoRepositorio = new tipoRepositorio($pdo);
    if($tipo == null or $tipo == 0){
      $tipoNomeSelect = "";
    }
    else{
      $tipoAtual = $tipoRepositorio->buscar($tipo);
      $tipoNomeSelect = $tipoAtual->getNome();
    }

	echo "
		  <p>Nome: $nome </p>
		  <p>Descrição: $descricao </p>
		  <p>Fabricante: $fabricante </p>
		  <p>Modelo: $modelo </p>
		  <p>Tipo: $tipoNomeSelect </p>
          <p>Quantidade: $quant </p>
          <p>Data de inclusão: $dataInclusao </p>
          <p>Data de baixa: $dataBaixa </p>
          <p>Valor carga: $valorCarga </p>
          <p>Data valor cotação: $dataValorCotacao </p>
          <p>Valor cotação: $valorCotacao </p>
          <p>Previa de alocação de material: $depNomeSelect </p>
          <p>Categoria de material: $catMat </p>
          <p>Número de série: $numSerie </p>";
?>
</body>
</html>