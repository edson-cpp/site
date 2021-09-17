<?php 
function __autoload($class){
   $arquivo = "class/".$class.".class.php";

  if(is_file($arquivo)){

   require_once ($arquivo);
   return;
  }
  $arquivo = "admin/class/".$class.".class.php";
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

      require_once("$class.class.php");
   }

}// fim da funcao

//instancia a classe sessão
$sessao = sessao::singleton();

if(isset($_POST['cad'])){
try{
		
	if(!$_POST['mail']){
		Throw new exception ("Digite um EMAIL válido!");
	}//fim if*/
	
	//envia os dados para cadastro	
    $sessao->confirmaMudSenha($_POST['mail']);
	echo "<script language=\"javascript\">alert('Confirmação solicitada, check seu email para concluir!');</script>";
	
}catch(Exception $e){
	echo "<script language=\"javascript\">alert(' ".$e->getMessage()."');</script>";
	
	/*"<script language=\"javascript\">alert(' ".$e->getMessage()."');</script>";*/
}
}//fim se 


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cadastro de Usuários</title>
</head>
<body>
<div style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
<fieldset>
<legend style="font-size:16px; font-weight:bold;">Recuperar usuário e senha</legend>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"> 

<p>Para recuperar seu usuário e senha basta digitar o email que foi cadastrado no ato da criação de sua conta.</p>
<p><strong>Email:</strong><span style="padding-left:9px;"><input type="text" name="mail" size="25" /></span><br /></p>

<center><input type="submit" value="Recuperar" name="cad" /></center>
</form>
</fieldset>
</div>
</body>
</html>