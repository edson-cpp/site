<?php 

function __autoload($class){
   $arquivo = "class/".$class.".class.php";

  if(is_file($arquivo)){

   require_once ($arquivo);
   return;
  }
  $arquivo = "../class/".$class.".class.php";
  if(is_file($arquivo)){

      require_once ($arquivo);
      return;
  }
  $arquivo = "../class/".$class.".class.php";
  if(is_file($arquivo)){

     require_once ($arquivo);
     return;

  }
  else{

      require_once("../class/$class.class.php");
   }

}// fim da funcao

//recebe os dados da url
$id   = $_GET['id'];
$mail = $_GET['email'];
$uid  = $_GET['uid'];
$key  = $_GET['key'];


//instancia classe necessaria

$sessao = sessao::singleton();
$db 	= db::singleton();
$val    = validacao::singleton();

try{
	//valida o email do usuario
	$val->validaEmail($mail);
	//valida o id
	$val->validaString($id);
	//busca informações para comparação
	$rt = $sessao->seleciona("usuario", "email, idunico, datasolic", "id", $id, "=");
	
	$valido = true;
	
	foreach($rt as $sql){
		if($sql->email != $email){
			$valido = false;
		}
		
		if(sha1($sql->idunico) != $uid){
			$valido = false;	
		}
		
		if(sha1($sql->datasolic) != $key){
			$valido = false;	
		}
	}//fim foreach
	
	if($valido === true){
		
		//efetua o update da senha
		$sessao->altera("usuario", "ativo", "1", "id", $id);
		$msg = "Sua conta foi ativada com sucesso, guarde bem seus dados, obrigado!";		
		
	}else{
		Throw new Exception("Dados de cofirmação inválidos, por tente novamente!");	
	}
	

}catch(Exception $e){
	
		$msg = $e->getMessage();
	
}



?>

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
        	<p style="color:#C03; font-size:16px; text-align:center;"><?php print($msg); ?></p> 
        </div> <!-- Fim meio conteudo -->
	</div><!-- Fim Meio -->
	<div id="rodape">
	 <?php include("../rodape.html"); ?>
  </div><!-- Fim Rodapé -->
</div><!-- Fim Geral -->
</body>
</html>
