/*
   Biblioteca de usu�rio usada para validar os campos do formul�rio quando ele for enviado (evento submit). Usada nos programas incEnd1.php e altEnd2.php. Al�m da fun��o de valida��o, essa biblioteca cont�m outros comandos que s�o executados nos dois programas mencionados (linhas 6 at� 39)

   Vari�vel global usada para guardar o campo de formul�rio onde ocorreu erro (o sistema detecta um erro de cada vez, atrav�s da fun��o validarDados()).  
*/
var inputAtivo = null;
 /*
   Coloca o cursor no input com id="nome" ap�s a p�gina ser carregada
*/
$("#cnome").focus();

/*
   Quando a janela modal com id="janelaModalErro" for fechada, o evento hidden.bs.modal � disparado, e a fun��o abaixo � executada. Nela, o cursor vai para o campo onde o erro ocorreu. O nome desse campo � colocado na vari�vel global javascript inputAtivo na fun��o validarDados(), no arquivo form.js.
*/
$("#janelaModalErro").on('hidden.bs.modal', function () {
   $(inputAtivo).focus();
})

/*
   Quando a janela modal com id="janelaModal" for fechada (janela de sucesso), o evento hidden.bs.modal � disparado, e essa fun��o � executada.
*/
$("#janelaModal").on('hidden.bs.modal', function () {
   /* 
      limpa todos os campos do formul�rio (reset)
   */
   $('#formAjax')[0].reset();

   // coloca o cursor no input com id="nome"
   $("#cnome").focus();
})

/*
   Volta para o primeiro programa de altera��o quando o bot�o "Voltar" for clicado (apenas no prograna altEnd2.php)
*/
$("#btnVoltar").click(function(){
   location.href = "altCad1.php";
})

/*----------------------------------------------------------------------*/

function validarDados(){

   if ( $("#cnome").val().trim().length == 0 ){

      //  mensagem de erro 
      $("#modalErroTitulo").text("Erro de Digitação");
      $("#modalErro").text("O campo nome não pode ficar em branco!");
      $("#janelaModalErro").modal();
      
      // guarda na vari�vel global inputAtivo o id do campo que est� ativo (onde o cursor est�)
      inputAtivo = "#cnome";

      // cancela o envio do formulario
      return false;
   }

   if ( $("#cemail").val().trim().length == 0 ){
      //  mensagem de erro 
      $("#modalErroTitulo").text("Erro de Digitação");
      $("#modalErro").text("O campo email não pode ficar em branco!");
      $("#janelaModalErro").modal();
      
      // guarda na vari�vel global inputAtivo o id do campo que est� ativo (onde o cursor est�)
      inputAtivo = "#cemail";

      // cancela o envio do formulario
      return false;
   }

   if ( $("#csenha").val().trim().length == 0 ){
      $("#modalErroTitulo").text("Erro de Digitação");
      $("#modalErro").text("O campo senha não pode ficar em branco!");
      $("#janelaModalErro").modal();
      
      // guarda na vari�vel global inputAtivo o id do campo que est� ativo (onde o cursor est�)
      inputAtivo = "#csenha";

      // cancela o envio do formulario
      return false;
   }

   /* Se nenhum erro ocorreu, retorna verdadeiro */
   return true;
}

