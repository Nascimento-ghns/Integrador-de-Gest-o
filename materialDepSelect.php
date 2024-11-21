<br>  
<form action="materialDependencia.php" method="post">
    <?php
        foreach($dependencias as $dependencia):
            $id = $dependencia->getId();
            $nome = $dependencia->getNome();
            echo "   <input type='checkbox' class='radio' name='dependencias[]' value='$id'><label>$nome</label>";
        endforeach;
    ?>
    <br>
    <button type='submit' name='' class='btn btn-info' >Buscar</button>
    <button type='reset' name='' class='btn btn-danger' >Limpar</button>
</form>

<?php

    foreach($_POST['dependencias'] as $idDependencia):
        $dependenciaRepositorio = new dependenciaRepositorio($pdo);
        $dependencia = $dependenciaRepositorio->buscar($idDependencia);
        $materialRepositorio = new materialRepositorio($pdo);
	    $material = $materialRepositorio->buscarDependencia($dependencia->getId());
        $depNome = $dependencia->getNome();
        echo"<br>
                <h2 class='centralizaTitulo'>Material em $depNome</h2>
                <br>
                <table style='width: 100%;' class='table table-striped table-bordered table-hover'>
                    <thead class='thead-dark'>
                        <tr>
                            <th style='display: none;'>Id</th>
                            <th class='text-center'>Nome</th>
                            <th class='text-center'>Modelo</th>
                            <th class='text-center'>Quantidade</th>
                            <th class='text-center'>Fabricante</th>
                        </tr>
                    </thead>
                    <tbody class=''>";
        foreach($material as $material):
            ?>
            <tr>
                <td style="display: none;"><?= $material->getId() ?></td>
                <td><?= $material->getNome() ?></td>
                <td><?= $material->getModelo() ?></td>
                <td class="text-center"><?= $material->getQuant() ?></td>
                <td><?= $material->getFabricante() ?></td>
            </tr>
            <?php
        endforeach;    
        echo "</tbody>
                </table>";
    endforeach;

    if(isset($_POST['dependencias'])){
        $respostas = $_POST['dependencias'];
        var_dump($respostas);
    }

?>