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

	echo "
		  <p>Nome: $nome </p>
		  <p>Descrição: $descricao </p>
		  <p>Fabricante: $fabricante </p>
		  <p>Modelo: $modelo </p>
		  <p>Tipo: $tipo </p>
          <p>Quantidade: $quant </p>
          <p>Data de inclusão: $dataInclusao </p>
          <p>Data de baixa: $dataBaixa </p>
          <p>Valor carga: $valorCarga </p>
          <p>Data valor cotação: $dataValorCotacao </p>
          <p>Valor cotação: $valorCotacao </p>
          <p>Previa de alocação de material: $prevAlocMat </p>
          <p>Categoria de material: $catMat </p>
          <p>Número de série: $numSerie </p>";
?>
</body>
</html>