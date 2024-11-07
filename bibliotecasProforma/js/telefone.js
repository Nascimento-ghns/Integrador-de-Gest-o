/*
	Biblioteca javascript usada pelo programa cadFone2.php. Contém as funções de inclusão, alteração e exclusão de telefones, além de controlar os botões do programa cadFon2.php

	Cria variável global para guardar <tr> clicada
*/
var linhaTabela = null;
/*
	Cria variáveis gobais para guardar os campos da tabela telefone. Os campos codEnd e nome são criados dentro do programa cadFone2.php
*/
var codFone     = null;
var fone        = null;
var codTipoFone = null;

$(document).ready(function(){
	/*
		Atualiza as funções associadas ao evento click dos botões da tabela (.btnEditar e .btnExcFone)
	*/
	atualizaBotoesTabela(); 

	$("#telefone").focus(function(){
		/*
			Quando o <input> com id=telefone recebe foco, essa função é executada. Se o campo #telefone estiver em branco, é inclusão, então o botão com id=btnNovo deve ser habilitado, removendo a classe Bootstrap ".disabled"
		*/
		if ( $("#telefone").val().trim().length == 0 ) {
			$("#btnNovo").removeClass('disabled');
		}
	})

	$("#btnVoltar").click(function(){
		/*
			Retorna ao programa cadFone1.php
		*/
		location.href ="cadFone1.php";
	})

	$("#btnCancelar").click(function(){
		/*
			Cancela inclusão ou alteração, desabilitando os botões e limpando o formulário
		*/
		$("#btnNovo").addClass('disabled');
		$("#btnAtualiza").addClass('disabled');
		$("#telefone").val("");
		$("#tipoFone").val("");
	})

	$("#btnNovo").click(function(){
		/*
			Função usada para incluir novo telefone. Chama o programa incTelefone.php, e envia os dados digitados. O if (teste de campo em branco) evita o envio de dados inválidos. OBS: são também enviados as variáveis nome e codEnd, pois elas serão usadas no programa incTelefone.php (pelo include montaTabelaTelefone.php).
		*/
		if ($("#telefone").val().trim().length>0 && $("#tipoFone").val().trim().length>0){
			fone        = $("#telefone").val();
		    codTipoFone = $("#tipoFone").val();

			$.ajax({
				type: "POST",
				data: { nome: nome,
						codEnd : codEnd,
				        fone : fone,
						codTipoFone: codTipoFone },
				url: "incTelefone.php",
				success: function( resposta ){
					if (resposta.indexOf("Erro") != -1 ) {
							$("#modalErroTitulo").html('Erro de Cadastramento');
							$("#modalErro").html( resposta );
							$("#janelaModalErro").modal();
						}
						else {
							/*
								Refaz a tabela de telefones, para exibir o registro que acabou de ser incluído
							*/
							$("#tabelaTelefone").html(resposta);
							/*
								Refaz a ligação dos botões dentro das <td> com suas respectivas funções jQuery.
							*/
							atualizaBotoesTabela();
							/*
								Exibe mensagem de inclusão bem sucedida
							*/
							$("#modalTextoTitulo").text("Inclusão bem sucedida");
							$("#modalTexto").html("Telefone incluído com sucesso: " + fone);
							$("#janelaModal").modal();
						}
				}
			});	
			// desabilita botão de novo tipo fone e limpa o formulário
			$("#btnNovo").addClass('disabled');
			$("#telefone").val("");
			$("#tipoFone").val("");
		}
	})


	$("#btnAtualiza").click(function(){
		/*
			Função executada para alterar um registro no banco de dados que tem a chave primária guardada na variável global codFone. Só pode ser executada após a execução da função $(".btnEditar").click(). OBS: também é enviada a variável nome, pois ela será usada no programa altTelefone.php (pelo include montaTabelaTelefone.php).
		*/
		if ($("#telefone").val().trim().length>0 && $("#tipoFone").val().trim().length>0){
			fone        = $("#telefone").val();
		    codTipoFone = $("#tipoFone").val();
			$.ajax({
				type: "POST",
				data: { nome: nome,
						codFone : codFone,
				        codEnd : codEnd,
				        fone : fone,
						codTipoFone: codTipoFone },
				url: "altTelefone.php",
				success: function( resposta ){
					if (resposta.indexOf("Erro") != -1 ) {
							$("#modalErroTitulo").html('Erro de Cadastramento');
							$("#modalErro").html( resposta );
							$("#janelaModalErro").modal();
						}
						else {
							/*
								Refaz a tabela de tipos de telefone
							*/
							$("#tabelaTelefone").html(resposta);
							/*
								Refaz a ligação dos botões dentro das <td> com suas respectivas funções jQuery.
							*/
							atualizaBotoesTabela();
							/*
								Exibe mensagem de alterção bem sucedida
							*/
							$("#modalTextoTitulo").text("Alteração bem sucedida");
							$("#modalTexto").html("Telefone alterado com sucesso: " + fone);
							$("#janelaModal").modal();
						}
				}
			});	
			// desabilita botão e limpa campos do formulário
			$("#btnAtualiza").addClass('disabled');
			$("#telefone").val("");
			$("#tipoFone").val("");
		}
	})

	$("#btnExcluir").click(function(){
		/*
			Essa função só é executada se o usuário clicar no botão "Excluir", exibido na janela modal de confirmação de exclusão. Essa janela é exibida pelo função $("#btnExcTipoFone").click() (ver função atualizaBotoesTabela)
		*/
		$.ajax({
				type: "POST",
				data: { nome: nome,
						codFone: codFone,
						codEnd: codEnd },
				url: "excTelefone.php",
				success: function( resposta ){
					if (resposta.indexOf("Erro") != -1 ) {
							$("#modalErroTitulo").html('Erro de Exclusão');
							$("#modalErro").html( resposta );
							$("#janelaModalErro").modal();
						}
						else {
							/*
								Refaz a tabela de tipos de telefone
							*/
							$("#tabelaTelefone").html(resposta);
							/*
								Refaz a ligação dos botões dentro das <td> com suas respectivas funções jQuery.
							*/
							atualizaBotoesTabela();
							/*
								Exibe mensagem de exclusão bem sucedida
							*/
							$("#modalTextoTitulo").text("Exclusão bem sucedida");
							$("#modalTexto").html("Telefone excluído: " + fone);
							$("#janelaModal").modal();
						}
				}
		});	
	})

})

/*=========================================================================================*/

function atualizaBotoesTabela(){
/*
	Função usada para associar funções ao evento click dos botões inseridos nas <td> da tabela (.btnEditar e .btnExcTipoFone). Executada uma vez após a página estar carregada, e SEMPRE após cada atualização feita na tabela. A execução dessa função é necessária para que os botões .btnEditar e .btnExcTipoFone recebam as funções associadas ao evento click. Caso contrário, eles param de funcionar após a primeira atualização da tabela feita por AJAX.
*/
	$(".btnEditar").click(function(){
		/*
			Função executada toda vez que um botão com classe ".btnEditar" é clicado. Usada para retirar os dados da linha clicada, para colocar o tipo fone no campo de formulário e para habilitar o botão btnAtualiza.

			Coloca na variável global "linhaTabela" a <tr> que contém o botão clicado. O primeiro método .parent() seleciona a <td> onde o botão está inserido e o segundo .parent() seleciona a <tr> onde a <td> está inserida.
		*/
		linhaTabela = $(this).parent().parent();
		/*
			Coloca nas variáveis globais os campos da tabela telefone guardados na linha que foi clicada
		*/
		codFone     = $(linhaTabela).children("td:nth-child(6)").text();		
		codEnd      = $(linhaTabela).children("td:nth-child(5)").text();		
		fone        = $(linhaTabela).children("td:nth-child(1)").text();		
		codTipoFone = $(linhaTabela).children("td:nth-child(8)").text();
		/*
			Coloca o telefone no campo do formulário
		*/
		$("#telefone").val(fone);
		/*
			Comando para selecionar a <option> de acordo com o valor armazenado em codTipoFone
		*/
		$("#tipoFone").val(codTipoFone);
		/*
			Desabilita o botão de inclusão e habilita o botão de atualização
		*/
		$("#btnNovo").addClass('disabled');
		$("#btnAtualiza").removeClass('disabled');
	})

	$(".btnExcFone").click(function(){
		/*
			Função executada toda vez que um botão com classe ".btnExcFone" é clicado. Usada para excluir registro selecionado. Após exclusão, tabela HTML é recriada a partir da tabela do banco de dados. 

			Coloca na variável global "linhaTabela" a <tr> que contém o botão clicado. O primeiro método .parent() seleciona a <td> onde o botão está inserido e o segundo .parent() seleciona a <tr> onde a <td> está inserida.
		*/
		linhaTabela = $(this).parent().parent();
		/*
			Retira o codigo e tipo fone (1ª e 2ª td) da linha da tabela que contém o botão clicado
		*/
		codFone = $(linhaTabela).children("td:nth-child(6)").text();
		fone    = $(linhaTabela).children("td:nth-child(1)").text();
		/* 
			Confirma a exclusão através de janela pop up
		*/
		$("#modalExcTexto").html( "Deseja realmente excluir definitivamente o telefone <b>"+fone+"</b>?");
		$("#modalExcTitulo").text("ATENÇÃO: Exclusão Definitiva de de Telefone");
		$("#janelaModalExclusao").modal();
		
	})

} // fim da função atualizaBotoesTabela()