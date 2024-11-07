/*
   biblioteca de usuário usada nos programas de cadastro de usuario para validar os campos do formulário quando ele for enviado (evento submit)
*/

function validarUsuario(){
/* Esta função recebe como parâmetro TODO o formulário. Ela é acionada pelo método submit
   da tag <form>
   
   A função testa os campos na ordem em que aparecem na tela. Para cada campo, em caso de 
   erro, os seguintes passos devem ser executados:
   1- Exibir mensagem de erro
   2- Colocar o cursor no campo com erro
   3- Cancelar o envio do formulário

   ATENÇÃO: Essa biblioteca só funciona associada ao plug-in jQuery MaskedInput, ao
            plug-in cpf-validate.1.0 e ao plugin .janelaPopUp incluído no arquivo popup.js

   TABELA DE CARACTERES ESPECIAIS EM UTF-8 PARA JAVASCRIPT

   á: \u00e1 à: \u00e0 â: \u00e2 ã: \u00e3 Á: \u00c1 À: \u00c0 Â: \u00c2 Ã: \u00c3
   é: \u00e9 è: \u00e8 ê: \u00ea É: \u00c9 È: \u00c8 Ê: \u00ca
   í: \u00ed ì: \u00ec Í: \u00cd Ì: \u00cc
   ó: \u00f3 ò: \u00f2 ô: \u00f4 õ: \u00f5 Ó: \u00d3 Ò: \u00d2 Ô: \u00d4 Õ: \u00d5
   ú: \u00fa ù: \u00f9 Ú: \u00da Ù: \u00d9
   ç? \u00e7 Ç: \u00c7 dois pontos (:) \u0027 &: \u0026
*/
   if ( $("#lemail").val().trim().length == 0 ){

      //  mensagem de erro 
      $("#modalErroTitulo").text("Erro de Digita\u00e7\u00e3o");
      $("#modalErro").text("O campo email n\u00e3o pode ficar em branco!");
      $("#janelaModalErro").modal();
      
      // guardar na variável global inputAtivo o id do campo
      // que está ativo (onde o cursor está)
      inputAtivo = "#lemail";

      // cancela o envio do formulario
      return false;
   }

   if ( $("#lsenha").val().trim().length == 0 ){
      //  mensagem de erro 
      $("#modalErroTitulo").text("Erro de Digita\u00e7\u00e3o");
      $("#modalErro").text("A senha n\u00e3o pode ficar em branco!");
      $("#janelaModalErro").modal();
      
      // guardar na variável global inputAtivo o id do campo
      // que está ativo (onde o cursor está)
      inputAtivo = "#lsenha";

      // cancela o envio do formulario
      return false;
   }

   if ( $("#senha_2").val().trim().length == 0 ){
      //  mensagem de erro 
      $("#modalErroTitulo").text("Erro de Digita\u00e7\u00e3o");
      $("#modalErro").text("A segunda senha n\u00e3o pode ficar em branco!");
      $("#janelaModalErro").modal();
      
      // guardar na variável global inputAtivo o id do campo
      // que está ativo (onde o cursor está)
      inputAtivo = "#senha_2";

      // cancela o envio do formulario
      return false;
   }

   if ( $("#senha_1").val() != $("#senha_2").val() ){
      $("#modalErroTitulo").text("Erro de Digita\u00e7\u00e3o");
      $("#modalErro").text("As duas senhas n\u00e3o podem ser diferentes!");
      $("#janelaModalErro").modal();
      
      // guardar na variável global inputAtivo o id do campo que está ativo (onde o cursor está)
      inputAtivo = "#senha_1";

      // cancela o envio do formulario
      return false;
   }
 
   if ( $("#acesso").val().trim().length == 0 ){
      $("#modalErroTitulo").text("Erro de Digita\u00e7\u00e3o");
      $("#modalErro").text("O campo acesso n\u00e3o pode ficar em branco!");
      $("#janelaModalErro").modal();
      
      // guardar na variável global inputAtivo o id do campo que está ativo (onde o cursor está)
      inputAtivo = "#acesso";

      // cancela o envio do formulario
      return false;
   }

   /* Se nenhum erro ocorreu, retorna verdadeiro */
   return true;
}
