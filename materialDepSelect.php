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
    <br>
    <hr>
</form>

<?php
     echo "
     <table style='width: 100%;' class='table table-striped table-bordered table-hover table-responsive'>
         <thead class='thead-dark'>
             <tr><th class='text-center' width='100%' colspan='4'>Buscar</th></tr>
             <tr>
                 <th style='display: none;'>Id</th>
                 <th class='text-center' width='50%'>Nome</th>
                 <th class='text-center' width='25%'>Modelo</th>
                 <th class='text-center' width='5%'>Quantidade</th>
                 <th class='text-center' width='20%'>Fabricante</th>
             </tr>
             <tr width='100%'>
                 <th style='display: none;'><input type='text' id='txtColuna1' width='15%'/></th>
                 <th width='50%'><input type='text' id='txtColuna1'></th>
                 <th width='25%'><input type='text' id='txtColuna2'></th>
                 <th width='5%'><input type='text' id='txtColuna3'></th>
                 <th width='20%'><input type='text' id='txtColuna4'></th>
             </tr>
         </thead>
     </table>";
    if(isset($_POST['dependencias'])){
        foreach($_POST['dependencias'] as $idDependencia):
            $dependenciaRepositorio = new dependenciaRepositorio($pdo);
            $dependencia = $dependenciaRepositorio->buscar($idDependencia);
            $materialRepositorio = new materialRepositorio($pdo);
            $material = $materialRepositorio->buscarDependencia($dependencia->getId());
            $depNome = $dependencia->getNome();
            echo"<br>
                    <h2 class='centralizaTitulo'>Material em $depNome</h2>
                    <br>
                    <table style='width: 100%;' class='table table-striped table-bordered table-hover table-responsive'>
                        <thead class='thead-dark'>
                            <tr>
                            <th style='display: none;'>Id</th>
                            <th class='text-center' width='50%'>Nome</th>
                            <th class='text-center' width='25%'>Modelo</th>
                            <th class='text-center' width='5%'>Quantidade</th>
                            <th class='text-center' width='20%'>Fabricante</th>
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
    }
    
?>