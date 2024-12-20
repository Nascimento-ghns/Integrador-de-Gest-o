<?php
print <<<HTML
<!-- ================================================ 
  Janela Modal para confirmar exclusão de registro
 ==================================================== -->
<div class="modal fade" id="janelaModalFim" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Título -->
            <div class="modal-header modal-header-warning">
                <h4 id="modalFimTitulo" class="modal-title"></h4>
            </div>
            <!-- Corpo -->
            <div class="modal-body">
                  <h4 id="modalFimTexto"></h4>
            </div>
            <!-- Rodapé -->
            <div class="modal-footer centraliza">
              <button id="btnFim" type="button" class="btn btn-warning" data-dismiss="modal">Confirmar Fim</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>   
    </div>
</div>   <!-- Fim da div id=janelaModalExclusao -->'
HTML;
?>