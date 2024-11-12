<?php
print <<<HTML
<!-- ====================================================== 
	Janela Modal para exibir mensagens de erro de digitação
=========================================================== -->
<div class="modal fade" id="janelaModalErro" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Título -->
            <div class="modal-header modal-header-danger">
                  <button id="btnFecharErro" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 id="modalErroTitulo" class="modal-title"></h4>
            </div>
            <!-- Corpo -->
            <div class="modal-body">
                  <h4 id="modalErro"></h4>
            </div>
            <!-- Rodapé -->
            <div class="modal-footer">
                  <button id="btnFimErro" type="button" class="btn btn-danger center-block" data-dismiss="modal">Fechar</button>
            </div>
        </div>
      
    </div>
</div>   <!-- Fim da div id=janelaModalErro -->
HTML;
?>