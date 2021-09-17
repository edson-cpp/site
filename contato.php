<?php

	//Pega a data do dia
	$data = date('Y-m-d');
	$msg = "";//variavel de mensagem


	//Define Email de envio
	$email = "comercial@cybersis.com.br";

	//Pega a dada do dia de envio
	$data = date('d-m-Y');

	//Pega o ip do usuario
	$ip = $_SERVER['REMOTE_ADDR'];

	$msg = "Data: ".$data."\n"; 
	$msg = "IP ADRESS: ".$ip."\n";
	$msg .= utf8_decode("Nome: ".$_POST['nome'])."\n";
	$msg .= utf8_decode("Email: ".$_POST['email'])."\n";
	$msg .= "Telefone: ".$_POST['telefone']."\n";
	$msg .= utf8_decode("Ramo: ".$_POST['ramo'])."\n";
	$msg .= utf8_decode("Mensagem: ".$_POST['mensagem'])."\n";

	//Cabeçalho da mensagem
	$assunto = "Formulario Contato!";


	if(isset($_POST['envia'])){
		//envia a mensagem 	 
		if(@ mail($email, $assunto, $msg, "From: ".$nome)){
			echo "<script language=\"javascript\">alert(\"Contato enviado com sucesso, logo entraremos em contato!\");</script>";
		}else{
			echo "<script language=\"javascript\">alert(\"Falha ao enviar, tente mais tarde!\");</script>";
		}
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
					<div class="cima"><div class="initTit">Formulário de Contato</div></div>
					<div class="meio">
						<div class="textoMeio" ><br />
							Entre em contato conosco e tire todas as suas dúvidas!<br /><br />
							Caso deseje entre em contato pelo telefone abaixo!<br /><br />
							<div class="iconeladocontato">
							Paraná - Shiptech Informática<br />
							Fone:(41) 3575-0161.<br /><br />
							Pará - Cristian Elias Spohr<br />
							Fone:(93) 3541-2297(Tim).<br /><br />
							Outras regiões<br />
							Fone:(41) 3575-0161.<br />
							Cel:(41) 9921-2349(Tim).<br /><br />
							Fone:(41) 3289-5784.<br />
							Cel:(41) 8438-0605(Tim).<br />
							Cel:(41) 8880-0975(Claro).</div>

							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"> 
								<span style="font-size:13px; font-weight:bold;">
									Nome Completo: <br />
									<input type="text" name="nome" size="30"  /><br /><br />
									E-mail:<br />
									<input type="text" name="email" size="30"  /><br /><br />
									Telefone: <br />
									<input type="text" name="telefone" size="25"  /><br /><br />
									Ramo Atividade:<br />
									<input type="text" name="ramo" size="30" /><br /><br />
									Mensagem:<br />
									<textarea name="mensagem" cols="40" rows="5"></textarea><br /><br />
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
