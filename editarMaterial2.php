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

    $id = $material->getId();
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
        <form method='post'>
          <input type='hidden' id='matId' name='matId' value='$id'>
          <p>Nome: <input type='text' id='matNome' name='matNome' value='$nome'> </p> 
          <p>Descrição: <input type='text' id='matDescricao' name='matDescricao' value='$descricao'> </p>
          <p>Fabricante: <input type='text' id='matFabricante' name='matFabricante' value='$fabricante'> </p>
          <p>Modelo: <input type='text' id='matModelo' name='matModelo' value='$modelo'> </p>
          <p>Tipo: <input type='text' id='matTipo' name='matTipo' value='$tipo'> </p>
          <p>Quantidade: <input type='text' id='matQuant' name='matQuant' value='$quant'> </p>
          <p>Data de inclusão: <input type='text' id='matDataInclusao' name='matDataInclusao' value='$dataInclusao'> </p>
          <p>Data de baixa: <input type='text' id='matDataBaixa' name='matDataBaixa' value='$dataBaixa'> </p>
          <p>Valor carga: <input type='text' id='matValorCarga' name='matValorCarga' value='$valorCarga'> </p>
          <p>Data valor cotação: <input type='text' id='matDataValorCotacao' name='matDataValorCotacao' value='$dataValorCotacao'> </p>
          <p>Valor cotação: <input type='text' id='matValorCotacao' name='matValorCotacao' value='$valorCotacao'> </p>
          <p>Previa de alocação de material: <input type='text' id='matPrevAlocMat' name='matPrevAlocDep' value='$prevAlocMat'> </p>
          <p>Categoria de material: <input type='text' id='matCatMat' name='matCatMat' value='$catMat'> </p>
          <p>Número de série: <input type='text' id='matNumSerie' name='matNumSerie' value='$numSerie'> </p>
          <button type='submit' name='editar' class='btn btn-success'>Alterar</button>
          <button type='submit' name='duplicar' class='btn btn-info'>Duplicar</button>
          <button type='submit' name='excluir' id='excluir' class='btn btn-danger'>Excluir</button>
        </form>  
          ";
?>
</body>
</html>