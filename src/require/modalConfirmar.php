<?php
print <<<HTML
<!-- ================================================ 
  Janela Modal para confirmar exclusão de registro
 ==================================================== -->
<div class="modal fade" id="janelaModalExclusao" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Título -->
            <div class="modal-header modal-header-warning">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 id="modalExcTitulo" class="modal-title"></h4>
            </div>
            <!-- Corpo -->
            <div class="modal-body">
                  <h4 id="modalExcTexto"></h4>
            </div>
            <!-- Rodapé -->
            <div class="modal-footer centraliza">
              <button id="btnExcluir" type="button" class="btn btn-warning" data-dismiss="modal">Confirmar Exclusão</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>   
    </div>
</div>   <!-- Fim da div id=janelaModalExclusao -->'
HTML;
?>