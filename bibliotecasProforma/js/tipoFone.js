/*
	Biblioteca javascript usada pelo programa cadTipoFone.php. Controla as funções CRUD na tabela fonetipo.

	Cria variável global para guardar <tr> clicada
*/
var linhaTabela = null;
/*
	Cria variáveis gobais para guardar os campos codtipofone e tipofone
*/
var codTipofone = null;
var tipoFone    = null;

$(document).ready(function(){
	/*
		Atualiza as funções associadas ao evento click dos botões da tabela (.btnEditar e .btnExcTipoFone)
	*/
	atualizaBotoesTabela(); 

	$("#nometipofone").focus(function(){
		/*
			Se o campo telefone estiver em branco, é inclusão, então o botão com id=btnNovo deve ser habilitado, removendo a classe Bootstrap ".disabled"
		*/
		if ( $("#nometipofone").val().trim().length == 0 )
			 $("#btnNovo").removeClass('disabled');
	})

	$("#btnCancelar").click(function(){
		/*
			Cancela inclusão ou alteração, desabilitando os botões e limpando o formulário
		*/
		$("#btnNovo").addClass('disabled');
		$("#btnAtualiza").addClass('disabled');
		$("#nometipofone").val("");
	})

	$("#btnNovo").click(function(){
		/*
			Função usada para incluir novo tipofone. Chama o programa incTipoFone.php, e envia o nometipofone digitado. O if (teste de campo em branco) evita o envio se campo estiver em branco
		*/
		if ($("#nometipofone").val().trim().length>0){
			var tipoFone = $("#nometipofone").val();
			$.ajax({
				type: "POST",
				data: { nomeTipoFone : tipoFone },
				url: "incTipoFone.php",
				success: function( resposta ){
					if (resposta.indexOf("Erro") != -1 ) {
							$("#modalErroTitulo").html('Erro de Cadastramento');
							$("#modalErro").html( resposta );
							$("#janelaModalErro").modal();
						}
						else {
							/*
								Refaz a tabela HTML de tipos de telefone após a inclusão
							*/
							$("#tabelaTipoFone").html(resposta);
							/*
								Refaz a ligação dos botões das tabelas com suas respectivas funções
							*/
							atualizaBotoesTabela();
							/*
								Exibe mensagem de inclusão bem sucedida
							*/
							$("#modalTextoTitulo").text("Inclusão bem sucedida");
							$("#modalTexto").html("Tipo de telefone incluído com sucesso: " + tipoFone);
							$("#janelaModal").modal();
						}
				}
			});	
			// desabilita botão de novo tipo fone
			$("#btnNovo").addClass('disabled');
			$("#nometipofone").val("");
		}
	})


	$("#btnAtualiza").click(function(){
		/*
			Função executada para alterar um registro no banco de dados que tem a chave primátia guardada na variável global codTipoFone. Só pode ser executada após a execução da função $(".btnEditar").click()
		*/
		if ($("#nometipofone").val().trim().length>0){
			var tipoFone = $("#nometipofone").val();
			$.ajax({
				type: "POST",
				data: { nomeTipoFone : tipoFone,
						codTipoFone: codTipofone },
				url: "altTipoFone.php",
				success: function( resposta ){
					if (resposta.indexOf("Erro") != -1 ) {
							$("#modalErroTitulo").html('Erro de Cadastramento');
							$("#modalErro").html( resposta );
							$("#janelaModalErro").modal();
						}
						else {
							/*
								Refaz a tabela HTML de tipos de telefone apóes a alteração
							*/
							$("#tabelaTipoFone").html(resposta);
							/*
								Refaz a ligação dos botões das tabelas com suas respectivas funções
							*/
							atualizaBotoesTabela();
							/*
								Exibe mensagem de inclusão bem sucedida
							*/
							$("#modalTextoTitulo").text("Alteração bem sucedida");
							$("#modalTexto").html("Tipo de telefone alterado com sucesso: "+tipoFone);
							$("#janelaModal").modal();
						}
				}
			});	
			// desabilita botão e limpa campo do formulário
			$("#btnAtualiza").addClass('disabled');
			$("#nometipofone").val("");
		}
	})

	$("#btnExcluir").click(function(){
		/*
			Essa função só é executada se o usuário clicar no botão "Excluir", exibido na janela modal de confirmação de exclusão. Essa janela é exibida pelo função $("#btnExcTipoFone").click() (ver função atualizaBotoesTabela)
		*/
		$.ajax({
				type: "POST",
				data: { codTipoFone: codTipofone },
				url: "excTipoFone.php",
				success: function( resposta ){
					if (resposta.indexOf("Erro") != -1 ) {
							$("#modalErroTitulo").html('Erro de Exclusão');
							$("#modalErro").html( resposta );
							$("#janelaModalErro").modal();
						}
						else {
							/*
								Refaz a tabela HTML de tipos de telefone após a exclusão
							*/
							$("#tabelaTipoFone").html(resposta);
							/*
								Refaz a ligação dos botões das tabelas com suas respectivas funções
							*/
							atualizaBotoesTabela();
							/*
								Exibe mensagem de exclusão bem sucedida
							*/
							$("#modalTextoTitulo").text("Exclusão bem sucedida");
							$("#modalTexto").html("Tipo de telefone excluído: " + tipoFone);
							$("#janelaModal").modal();
						}
				}
		});	
	})

})

/*===============================================================*/

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
			Coloca em variáveis o codigo (1ª td) e o tipofone (2ª td) da linha da tabela que contém o botão clicado
		*/
		codTipofone = $(linhaTabela).children("td:nth-child(1)").text();		
		tipoFone    = $(linhaTabela).children("td:nth-child(2)").text();
		/*
			Coloca o tipo fone no campo do formulário
		*/
		$("#nometipofone").val(tipoFone);
		/*
			Desabilita o botão de inclusão e habilita o botão de atualização
		*/
		$("#btnNovo").addClass('disabled');
		$("#btnAtualiza").removeClass('disabled');
	})

	$(".btnExcTipoFone").click(function(){
		/*
			Função executada toda vez que um botão com classe ".btnExcTipoFone" é clicado. Usada para excluir registro selecionado. Após exclusão, tabela HTML é recriada a partir da tabela do banco de dados. Observação: se o registro da tabela já estiver associado a algum registro da tabela telefone, ocorrerá o erro MySQL #1451.

			Coloca na variável global "linhaTabela" a <tr> que contém o botão clicado. O primeiro método .parent() seleciona a <td> onde o botão está inserido e o segundo .parent() seleciona a <tr> onde a <td> está inserida.
		*/
		linhaTabela = $(this).parent().parent();
		/*
			Retira o codigo e tipo fone (1ª e 2ª td) da linha da tabela que contém o botão clicado
		*/
		codTipofone = $(linhaTabela).children("td:nth-child(1)").text();
		tipoFone    = $(linhaTabela).children("td:nth-child(2)").text();
		/* 
			Confirma a exclusão através de janela pop up
		*/
		$("#modalExcTexto").html( "Deseja realmente excluir definitivamente o tipo de telefone <b>"+tipoFone+"</b>?");
		$("#modalExcTitulo").text("ATENÇÃO: Exclusão Definitiva de Endereço e Telefones");
		$("#janelaModalExclusao").modal();
		
	})

} // fim da função atualizaBotoesTabela()