<?php
print <<<HTML
<!-- ============================================ 
	Janela Modal para exibir mensagens de consulta
  =============================================== -->
<div class="modal fade row" id="janelaModalInfo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Título -->
            <div class="modal-header modal-header-info">
                  </span><h4 id="modalInfoTitulo" class="modal-title"></h4>
            </div>
            <!-- Corpo -->
            <div class="modal-body">
                  <h4 id="modalTextoInfo"></h4>
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