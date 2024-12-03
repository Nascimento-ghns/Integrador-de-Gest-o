
<?php require "src/require/acesso.php"; ?>

<?php

	$ordemNum = $_POST['numOrdem'];
	$nomeTecnico = $_POST['nomeTecnico'];
	
    require "src/conexaoBD.php";
    require "src/modelo/OSv.php";
    require "src/repositorio/OSvRepositorio.php";

    $OSvRepositorio = new OSvRepositorio($pdo);
	$OSv = $OSvRepositorio->excluirTecnico($nomeTecnico, $ordem);

    