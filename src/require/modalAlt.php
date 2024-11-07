<?php

if (isset($_POST['editar'])){
    $material = new Material($_POST['matId'], $_POST['matNome'], $_POST['matDescricao'], $_POST['matFabricante'], $_POST['matModelo'], $_POST['matTipo'], $_POST['matQuant'], $_POST['matDataInclusao'], $_POST['matDataBaixa'], $_POST['matValorCarga'], $_POST['matDataValorCotacao'], $_POST['matValorCotacao'], $_POST['matPrevAlocDep'], $_POST['matCatMat'], $_POST['matNumSerie']);
    $materialRepositorio->atualizar($material);
}
if (isset($_POST['excluir'])){
    $materialRepositorio->excluir($_POST['matId']);
}

?>
<?php
print <<<HTML
<!-- ============================================ 
	Janela Modal para exibir mensagens de consulta
  =============================================== -->
<div class="modal fade row" id="janelaModalAlt" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Título -->
            <div class="modal-header modal-header-info">
                  </span><h4 id="modalAltTitulo" class="modal-title"></h4>
            </div>
            <!-- Corpo -->
            <div class="modal-body">
                  <h4 id="modalTextoAlt"></h4>
            </div>
            <!-- Rodapé -->
            <div class="modal-footer">
                  <button type="button" class="btn btn-info center-block" data-dismiss="modal">Fechar</button>
            </div>
        </div>
      
    </div>
</div>   <!-- Fim da div id=janelaModalInfo -->
HTML;
?>
