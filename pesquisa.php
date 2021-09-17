<?php

	//Pega a data do dia
	$data = date('Y-m-d');
	$msg = "";//variavel de mensagem


	//Define Email de envio
	$email = "suporte@cybersis.com.br";
	
	//Pega a dada do dia de envio
	$data = date('d-m-Y');
	
	//Pega o ip do usuario
	$ip = $_SERVER['REMOTE_ADDR'];
	
	$msg = "Data: ".$data."\n"; 
	$msg = "IP ADRESS: ".$ip."\n";
	$msg .= utf8_decode("Ramo Atividade: ".$_POST['ramo'])."\n";
	$msg .= utf8_decode("Estado: ".$_POST['estado'])."\n";
	$msg .= utf8_decode("Porte da Empresa: ".$_POST['porte'])."\n";
	$msg .= utf8_decode("Opinião Uso: ".$_POST['opUsoCgs'])."\n";
	$msg .= utf8_decode("Melhoria: ".$_POST['melhoria'])."\n";
	$msg .= utf8_decode("Função: ".$_POST['funcao'])."\n";
	
	//Cabeçalho da mensagem
	$assunto = utf8_decode("Pesquisa de Satisfação!");

   
   if(isset($_POST['envia'])){
   //envia a mensagem 	 
	@ mail($email, $assunto, $msg);
	echo "<script language=\"javascript\">alert(\"Pesquisa enviada com sucesso!\");</script>";
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("include/metaname.php"); ?>
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>

<body class="Estrutura">
<div id="geral">
<div id="header">
     <?php include("topo.html"); ?>
    </div><!-- Fim Cabeçalho -->
    <div id="menuEsq">
      <?php include("menu.html"); ?>
    </div><!-- Fim Menu Esquerdo -->
	<div id="menuDir">
	 <?php include("direita.php"); ?>
	</div><!-- Fim Menu Direito -->
    <div id="meio">
    	<div id="cantocima"></div>
    	<div id="meioconteudo">
        	<div class="cima"><div class="initTit">Pesquisa de Satisfação</div></div>
            <div class="meio">
            <div class="textoMeio" ><br />
           	Visando sempre alcançar a melhor experiência para nossos clientes, a Cybersis conta com a sua participação no desenvolvimento do CGS a fim de deixá-lo cada vez mais simples, rápido e confiável! <br /><br />
            <div class="iconeladapesquisa"><center><strong>Ajude a melhorar!</strong></center><br />
           <span style="text-align:left;"> CGS - Sistema de Gestão Comercial.<br />
            Pequenas e médias empresas.</span></div>
            
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"> 
				<span style="font-size:13px; font-weight:bold;">
                    Ramo de atividade:<br />
                    <input type="text" name="ramo" size="35"  title="Ramo Atividade!" /> *<br /><br />
                    Estado de origem:<br />
                    <input type="text" name="estado" size="30" /><br /><br  /> 
                    Porte de sua empresa? <br />
                    <select name="porte" title="Porte da empresa!">
                    	<option value="ate 5">Até 5 funcionários</option>
                    	<option value="5 a 25">De 5 a 25 funcionários</option>
                    	<option value="acima de 25"> Mais de 25 funcionários</option>
                    </select><br /><br />
                    Como foi sua adaptação ao CGS?<br />
                    <select name="opUsoCgs" title="Opnião facilidade de uso!">
                    	<option value="Muito Facil" selected="selected">Muito Fácil</option>
                        <option value="Facil">Fácil</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Dificil">Difícil</option>
                        <option value="Muito Dificil">Muito Dificil</option>
                    </select><br /><br />
                    Em sua opinião o que poderia melhorar no sistema.<br />
                    <textarea name="melhoria" cols="40" rows="4"></textarea><br /><br />
                    Há alguma função que procura e ainda não encontrou em nenhum sistema.<br />
                    <textarea name="funcao" cols="40" rows="5"></textarea><br /><br />
               </span>
    			<center><input type="submit" name="envia" value="Enviar"  /></center>
            </form>
            </div>
         </div><!--Fim div Meio -->
            <div class="baixo"></div>
        </div> <!-- Fim meio conteudo -->
	</div><!-- Fim Meio -->
	<div id="rodape">
	 <?php include("rodape.html"); ?>
  </div><!-- Fim Rodapé -->
</div><!-- Fim Geral -->
</body>
</html>
