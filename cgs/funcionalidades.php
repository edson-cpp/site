<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("../include/metaname.php"); ?>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
</head>

<body class="Estrutura">
<div id="geral">
<div id="header">
     <?php include("../topo.html"); ?>
    </div><!-- Fim Cabeçalho -->
    <div id="menuEsq">
      <?php include("../menu.html"); ?>
    </div><!-- Fim Menu Esquerdo -->
	<div id="menuDir">
	 <?php include("../direita.php"); ?>
	</div><!-- Fim Menu Direito -->
    <div id="meio">
    	<div id="cantocima"></div>
    	<div id="meioconteudo">
        	<div class="cima"><div class="initTit">Principais Funcionalidades</div></div>
            <div class="meio" >
            <div style="height:25px;">&nbsp;</div> 
            
             <div class="descricaoFunc">
    	<img src="../img/descfinanceiro.jpg" title="Financeiro" />
         Bancos.<br />
		 Contas.<br />
		 Centro de Custo.<br />
		 Conta Orçamentária.<br />
		 Tipos de Documentos.<br />
		 CFOP - Código Fiscal de Operação e Prestação.<br />
		 Observações da Nota Fiscal.<br />
         Administradoras de Cartão de Crédito.<br />
		 Cartões de Crédito.<br />
        
    </div><!-- Fim descrição -->
    <div class="descricaoFunc" style="float:right; margin-right:10px; margin-top: -204px;">
    	  <img src="../img/desccadastros.jpg" title="Cadastros" />
    	  Clientes.<br />
	 	  Fornecedores.<br />
		  Vendedores.<br />
		  Colaboradores.<br />
		  Transportadores.<br />
		  Produtos.<br />
 		  Grupos e SubGrupos de produtos.<br />
		  Fabricantes.<br />
    
    </div>
    
	<div class="descricaoFunc"  style="float:right; margin-right:10px; margin-top: -11px; height:303px;">
    	 <img src="../img/descmovimentacao.jpg" title="Movimentação" />
        Lançamento e Baixa de Contas a Receber.<br />
    	Lançamento e Baixa de Contas a Pagar.<br />
    	Recebimento de Cartão de Crédito.<br />
    	Recebimento de Crediário.<br />
    	Recebimento de Boleto.<br />
    	Frente de Loja.<br />
    	Controle de vendas.<br />
    	Pré-Venda / Orçamento.<br />
    	Controle de Pré-Vendas e Orçamentos.<br />
    	Nota Fiscal.<br />
    	Boleto.<br />
    	Ordem de Serviço.<br />
    	Entrada de produtos.<br />
    	Controle de compras.<br />
    	Lançamento e Controle de Cheques.<br />
    	Fluxo de Caixa.<br />
    </div>
    <br />
    <div class="descricaoFunc">
      <img src="../img/descrelatorio.jpg" title="Relatórios" />    
  	  Vendas.<br />
      Compras.<br />
      Clientes.<br />
      Produtos.<br />
      Cheques.<br />
      Contas a receber.<br />
      Contas a pagar.<br />

    </div>
    <br />
    <div class="descricaoFunc">
     <img src="../img/descferramentas.jpg" title="Ferramentas" />
      Centro de Controle.<br />
      Configurações Locais.<br />
      Gerenciamento de Estações de Trabalho.<br />
      Cópia de Segurança (Backup).<br />

    </div>
    <br />
            
     <div class="initTit"> Outras Características</div>       
            <div class="descCaracteristicas">
            <div style="height:10px;">&nbsp;</div> 
    * Controle de acessos em nível de usuário.<br />
    <span class="log">* Erros são gravados em log para posterior análise.</span><br />
      * Bloqueia exclusão de registros com relacionamentos.<br />
   <span class="log">* Sistema de ajuda rápido e prático.</span><br />
    * Tratamento de erros - não permite a quebra do sistema por falhas de gravação ou leitura de disco.<br />
   <span class="log">* Controle de transações - não permite a gravação inconsistente dos dados de uma operação.</span><br />
    * Multi tarefas - permite a abertura de várias telas simultaneamente.<br />
     <span class="log">* Comissão de venda pode ser definida por produto, venda ou vendedor.</span><br />
    * Permite bloquear venda para cliente com restrição de crédito.<br />
    <span class="log">* Permite bloquear a venda de produto com estoque insuficiente.</span><br />
    * Permite limitar o desconto na venda para uma quantidade máxima definida pelo administrador.<br />
     <span class="log">* Permite cadastrar vários endereços por cliente.</span><br /><br />
    
    * Função para auto-peças: Permite atualizar o preço de custo a partir de um custo fixo aplicando-se um percentual de desconto.<br />
     <span class="log">* Funçao para autocenter, mecânica e loja de som e alarme: Permite localizar o cliente a partir de um veículo cadastrado e também permite o cadastro de vários veículos por cliente.</span><br />
    * Permite escolher entre três tipos de código: sequencial, interno ou de barras.<br />
     <span class="log">* Permite imprimir até 5 cópias do recibo de pedido.</span><br /><br />
    
 <b>* Permite a emissão de relatórios em várias formas: </b><br />
      
       <span style="padding-left:15px;"> - Imprimir direto para impressora.</span><br />
       <span style="padding-left:15px;"> - Exibir na tela. </span><br />
       <span style="padding-left:15px;"> - Imprime em arquivo texto(txt).</span><br />
       <span style="padding-left:15px;"> - Arquivo da web(html).</span><br />
       <span style="padding-left:15px;"> - Arquivo do excel(xls).</span><br /><br />
      </span>
   
	</div>
            </div><!--Fim div Meio -->
            <div class="baixo"></div>

        </div> <!-- Fim meio conteudo -->
	</div><!-- Fim Meio -->
	<div id="rodape">
	 <?php include("../rodape.html"); ?>
  </div><!-- Fim Rodapé -->
</div><!-- Fim Geral -->
</body>
</html>
