<?php
print <<<HTML
<!-- =========================================================== 
	Janela Modal para exibir mensagens de envio Ok do formulário
================================================================ -->
<div class="modal fade" id="janelaModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Título -->
            <div class="modal-header modal-header-success">
                  <button id="btnFechar" type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 id="modalTextoTitulo" class="modal-title"></h4>
            </div>
            <!-- Corpo -->
            <div class="modal-body">
                  <h4 id="modalTexto"></h4>
            </div>
            <!-- Rodapé -->
            <div class="modal-footer">
                  <button id="btnFim" type="button" class="btn btn-success center-block" data-dismiss="modal" onClick="window.location.reload()">Fechar</button>
            </div>
        </div>
      
    </div>
</div>   <!-- Fim da div id=janelaModal -->'
HTML;
?>