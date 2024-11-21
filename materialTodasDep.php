<?php
    foreach($dependencias as $dependencias):
        $materialRepositorio = new materialRepositorio($pdo);
	    $material = $materialRepositorio->buscarDependencia($dependencias->getId());
        $dependencia = $dependencias->getNome();
        echo"<br>
                <h2 class='centralizaTitulo'>Material em $dependencia</h2>
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
?>