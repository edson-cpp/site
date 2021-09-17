<?php

	//Pega a data do dia
	$data = date('Y-m-d');
	$msg = "";//variavel de mensagem
	
	//Define Email de envio
	$email = "contato@webprod.com.br";
	
	//Pega a dada do dia de envio
	$data = date('d-m-Y');
	
	//Pega o ip do usuario
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$msg = "Data: ".$data."\n"; 
	$msg = "IP ADRESS: ".$ip."\n";
	$msg .= "Nome: ".utf8_decode($_POST['nomeEmp'])."\n";
	$msg .= "Email: ".$_POST['email']."\n";
	$msg .= "Contato: ".utf8_decode($_POST['contato'])."\n";
	$msg .= "Telefone: ".$_POST['fone']."\n";
	$msg .= "Servidor Windows: ".$_POST['servWin']."\n";
	$msg .= "Servidos Linux: ".$_POST['servLin']."\n";
	$msg .= "Computadores: ".$_POST['comput']."\n";
	$msg .= "Notebooks: ".$_POST['note']."\n";
	$msg .= utf8_decode("Observações: ".$_POST['obs'])."\n";
	

	//Cabeçalho da mensagem
	$assunto = "Proposta para contrato manutenção!";

   
   if(isset($_POST['envia'])){
   //envia a mensagem 	 
	if(@ mail($email, $assunto, $msg, "From: Cybersis Informática")){
		echo "<script language=\"javascript\">alert(\"Informações recebidas, em instantes um consultor entrará em contato, obrigado!\");</script>";
	}else{
		echo "<script language=\"javascript\">alert(\"Falha ao enviar, tente mais tarde!\");</script>";
	}
   }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("..//include/metaname.php"); ?>
<link href="../css/css.css" rel="stylesheet" type="text/css" />
<link href="../css/highslide.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="../highslide/highslide-with-html.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
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
        	<div class="titus">Manutenção de Computadores</div>
            <div style="padding:5px; background:#069;float:right; width:307px; margin-top:17px;">
            <img src="../img/manutencao_computador.jpg" style=""  /></div>
            <div class="txt">

            
            
	<p style="margin-right:325px; text-indent:15px;">Contrato de Manutenção é investimento e não despesa, além de ser mais barato do que você imagina. <br /><b><center>Já fez as contas de quanto custa um colaborador sem equipamento para trabalhar?</center></b></p>
    
	<p style="margin-right:325px; text-indent:15px;">Todos os serviços abaixo descritos podem ser executados em visitas técnicas avulsas, porém com um contrato mensal de manutenção sua empresa terá prioridade no atendimento pois consiste em formalizar uma parceria entre sua Empresa e a Cybersis Informatica em parceria com a HDLAN Informática cuidar de sua estrutura de informática mantendo sempre em bom funcionamento. </p>
    
   <br /> <p style="text-align:center;"><b>Segue abaixo algumas facilidades que você terá contratando a Cybersis Informática.</b></p>
    
   <span style="font-size:11px;">  * Atendimento em no máximo 6 horas úteis;<br />
    * Manutenções preventivas de todos os equipamentos contratados:<br />
    <img src="../img/HDD.png" style="float:right;" />
    		<span style="padding-left:25px; text-decoration:">- verificação de soluções anti-virus e anti-Spyware;</span><br />
            <span style="padding-left:25px;">- verificação física, lógica e performace da rede;</span><br />
            <span style="padding-left:25px;">- verificação detalhada da configuração dos equipamentos contratados;</span><br />
            <span style="padding-left:25px;">- limpeza de registro, disco e desfragmentação;</span><br />
            <span style="padding-left:25px;">- limpeza interna e externa do equipamento;</span><br />
            <span style="padding-left:25px;">- Orientação quanto a compra de equipamentos e softwares;</span><br />
            <span style="padding-left:25px;">- Entre muitas outras detalhadas em contrato.</span><br />
    * Abertura de Chamados via Telefone, E-mail, Chat-online, Messenger, ou web;<br />
    * Acompanhamento via WEB dos Equipamentos em Laboratório e dos chamados Abertos.<br />
    * SETUP (Limpeza Inicial fisica e lógica) de todo o parque de equipamentos do cliente na contratação.<br />
    * Otimização e remanejamento dos equipamentos, caso necessário.<br />
    * Relatório Conclusivo com as principais sugestões nos quesitos performance, segurança, estabilidade e backup.<br />
    * Relatório Mensal detalhado de todos os atendimentos realizados em sua empresa.<br /></span>

<p style="text-align:center; font-weight:bold;">Faça a sua cotação agora mesmo, preencha o formulário abaixo com as principais características de sua estrutura de equipamentos e nós enviaremos uma proposta para você!</p>
            <img src="../img/logos.jpg" style="float:right"  />
            <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
            	
                Nome da Empresa:<br /> <input type="text" name="nomeEmp" size="35" /><br />
                Email:			<br /> <input type="text" name="email"   size="35" /><br />
                Nome contato:   <br /> <input type="text" name="contato" size="35" /><br />
                Telefone:		<br /> <input type="text" name="fone"    size="35" /><br />
                <span style="font-weight:bold;"><center>Digite abaixo a quantidade de equipamentos que serão cobertos pela proposta.</center></span>
                Servidor Windows: <br /><input type="text" name="serWin" size="4" /><br />
                Servidor Linux:  <br /><input type="text" name="serLin" size="4" /><br />
                Computadores: 	 <br /><input type="text" name="comput" size="4" /><br />
                Notebooks:       <br /><input type="text" name="note" size="4" /><br />
                Observações:<br /><textarea name="obs" rows="5" cols="40"></textarea><br /><br />
                <input type="submit" name="envia" value="Solicitar" />
            
            </form>
            </div><!--fim div txt-->
        </div> <!-- Fim meio conteudo -->
	</div><!-- Fim Meio -->
	<div id="rodape">
	 <?php include("../rodape.html"); ?>
  </div><!-- Fim Rodapé -->
</div><!-- Fim Geral -->
</body>
</html>
