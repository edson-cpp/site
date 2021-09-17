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
		
	if(!$_POST['nome']){
		Throw new exception ("Digite o seu nome no campo NOME!");
	}//fim if
	if(!$_POST['email']){
		Throw new exception ("Digite um EMAIL válido!");
	}//fim if*/
	if(!$_POST['usuario']){
		Throw new exception ("Digite um nome de USUÁRIO!");
	}//fim if
	if(!$_POST['password']){
		Throw new exception ("Digite uma senha no campo SENHA!");
	}//fim if
	
	//envia os dados para cadastro	
    $sessao->cadastra($_POST['nome'], $_POST['email'], $_POST['usuario'], md5($_POST['password']));
	echo "<script language=\"javascript\">alert('Usuário cadastrado com Sucesso, verifique seu email para ativar sua conta!'); </script>";
	
	
}catch(Exception $e){
	echo "<script language=\"javascript\">alert(' ".$e->getMessage()."');</script>";
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
<legend style="font-size:16px; font-weight:bold;">Cadastro de Usuários</legend>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"> 

<p><strong>Nome:</strong><span style="padding-left:20px;"><input type="text" name="nome" size="25" /></span><br /></p>
<p><strong>E-mail:</strong><span style="padding-left:17px;"><input type="text" name="email" size="25" /></span><br /></p>
<p><strong>Usuário:</strong><span style="padding-left:9px;"><input type="text" name="usuario" size="25" /></span><br /></p>
<p><strong>Senha</strong><span style="padding-left:20px;"><input type="password" name="password"  size="25" /></span><br /><br />

<center><input type="submit" value="Cadastra" name="cad" /></center>
</form>
</fieldset>
</div>
</body>
</html>