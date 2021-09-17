<?php 
	
	class sessao {
		
		/**
		* @name Class Produto
		* @author Cesar Francisco Bueno
		* @version 0.1.3
		* Classe responsável pela inserção Alteração e Exclusão de Usuarios
		**/
		
		private static $instancia;
		
		
		function __construct(){
			
		}
		
		/*###########################################################################################################*/
		
		/**
		* metodo singleton responsável pela geração de objetos da classe garantindo  que apenas um objeto da classe * seja instanciado por  no programa
		**/
		
		public static function singleton() {
		  if(self::$instancia == null){
		     self::$instancia = new self();
		  }
		  
		  return self::$instancia;
		}
		
	
	
	
	/*##############################################################################################################*/
	
	/**
	* Método responsável por efetuar o login
	* @param $bd STRING string com o nome do banco de dados
	* @param $cond STRING string com o nome do campo a ser buscado
	* @param $campos STRING string valor a ser comparado na busca
	* @param $id_prod STRING string com o os campos ser comparados
	**/
	public function login($usuario, $senha){
	
	//limpa sessões caso existam
	$_SESSION['id']		= "";
	$_SESSION['nome']   = "";
    $_SESSION['tipo']   = "";
	
	
	$v = validacao::singleton();
			
	//Verifica se o usuario está entrando com caracteres impróprios		
	$v->validaString($usuario);
	//verifica se a conta do usuário ja foi ativada e email válido confirmado
	self::ativaConta("usuario", $usuario);
	
	$db = db::singleton();
	$db->setJoin("");
	
	$campo   = array(utf8_decode($usuario), md5($senha));
	$valores = array("usuario", "senha");
	$operador = array("=", "=");
	
	try{
	  $db->select("usuario", "id, nome, usuario, nivel", $valores, $campo, $operador);
	  
	  if($db->getNumLinhas() != 0){
         $usuario = $db->getResultado()->FetchObject();
         $this->reg_sessao($usuario);

	  }else{
		  Throw new Exception ("Usuario ou senha inválidos ou não encontrados!");
	  }
	  
		}
		catch(Exception $e){
			Throw new Exception ("Usuario ou senha inválidos ou não encontrados!");
		}	
		
	}//fim função
	
	
	/*##############################################################################################################*/
	
	private function reg_sessao($usuario){

         $_SESSION['id']      = $usuario->id;
         $_SESSION['nome']    = $usuario->nome;
		 $_SESSION['usuario'] = $usuario->usuario;
		 $_SESSION['nivel']	  = $usuario->nivel;
		 
		 $this->redireciona();
	
	}
	
	/*##############################################################################################################*/
	
	private function redireciona(){
        
		header("Location: admin/index.php");
        exit;
	}
	
	//Se a sessão for inválida volta para a index do site
	static function valida_login(){

        $url = "../index.php";
        if(empty($_SESSION['nome'])){
            header("Location: $url");
            exit;

        }
    }// fim da função

	/*##############################################################################################################*/

	public function sair(){

        unset($_SESSION['nome']);
        unset($_SESSION['id']);
		unset($_SESSION['usuario']);
		unset($_SESSION['nivel']);

        session_destroy();
        header("Location: ../index.php");
        exit;
    }
	
	/*##############################################################################################################*/	

    /**
     *@param Array array com informações do que será cadastrado
    **/

    //Função para cadastrar usuários
    public function cadastra($nome, $mail, $usuario, $senha, $tipo="2"){
		
		//Pega a data do dia do cadastro
		$data = date('Y-m-d');
		
		//data inicial da solicitação da recuperação da senha
		$dataSol = "0000-00-00";
		
		//define o id unico do usuario
		$uid = uniqid(rand(), true);
		
		//Define a situação inicial do usuário
		$ativo = 0;
		
		//instancia a classe de validação dos dados
		$val = validacao::singleton();
				
		//valida dados	
		$val->validaString($nome);
		$val->validaString($usuario);
		$val->validaString($senha);
		$val->validaEmail($mail);
		
		
		//Verifica se o nome de Usuário ja existe no sistema.
		self::verifUsua($usuario);
		self::verifEmail($mail);
		
		
        $valores = array(utf8_decode($nome), $mail, $tipo, utf8_decode($usuario), $senha, $data, $uid, $dataSol, $ativo);
        $campos  = array("nome", "email", "nivel", "usuario","senha", "datacad", "idunico", "datasolic", "ativo");
		
        try{
        $db = db::singleton();		
		$db->setJoin("");
        $db->insere("usuario", $valores, $campos);
        }
        catch(Exception $e){
            Throw new Exception ($e);
        }//fim try
		
		
		//envia um email para o usuario ativar sua conta
		
		$pega = $this->seleciona("usuario", "id, email, idunico, datasolic", "email", $mail);
		
		foreach($pega as $sql){
				
			$url = sprintf('id=%s&email=%s&uid=%s&key=%s', $sql->id, $sql->email, sha1($sql->idunico), sha1($sql->datasolic));
				
			$msg = "Para confirmar seu cadastro administrativo Cybersis, clique no link abaixo"."\n";
			$msg .= sprintf("http://www.webprod.com.br/usuario/confirma.php?%s", $url);
			
			//envia o email
			if(!@mail($sql->email, "Confirmação de Cadastro Cybersis", $msg, "From: Cybersis Informatica")){
				Throw new Exception("Falha ao enviar email de confirmação!");
			}
			
		}
		
		
		
    }//fim função
	
	/*########################################	VERIF USUA  ###########################################*/
	
	
	
	/**
	* Método rsponsável pela validaçao dos dados digitados nos formulários
	* @param $pass String string com o valor a ser comparado
	**/
	private function verifUsua($pass){
		
	
		try{
		
		$db = db::singleton();
		$db->setJoin("");
		$db->select("usuario", "usuario", "usuario", $pass);
		
		if($db->getNumLinhas() == 1 ){
			Throw new Exception ("");	
		}		   
		
		}catch(Exception $e){
			Throw new Exception ("Usuário ".$pass." já exite, digite outro!");	
		}
	}

//#################################################	VERIFICA EMAIL ################################################
	/*
	* Método responsável por verificar se um email já se encontra cadastrado
	* @param $mpass String string com o email a ser comparado
	*/
	private function verifEmail($mpass){
		
	
		try{
		
		$db = db::singleton();
		$db->setJoin("");
		$db->select("usuario", "usuario", "email", $mpass);
		
		if($db->getNumLinhas() == 1 ){
			Throw new Exception ("");	
		}		   
		
		}catch(Exception $e){
			Throw new Exception ("Email já cadastrado, tente recuperar sua senha!");	
		}
	}
	
	/*############################################ ATIVA CONTA  ##########################################*/
	/*
	* Método rsponsável por verificar se a conta do usuário foi ativada
	* @param $sqlCampo String string com o nome do campo sql a ser comparado
	* @param $sqlValor String string com o valor a ser comparado na busca
	*/
	private function ativaConta($sqlCampo, $sqlValor){
			
 				
			$ret = $this->seleciona("usuario", "ativo", $sqlCampo, $sqlValor);
			
			if(is_array($ret)){ // verifica se houve algum retorno se não não faz nada 
			foreach($ret as $sql){
				if($sql->ativo == 0){
					Throw new Exception("Conta não ativada, verifique seu email para confirmar seu cadastro!");
				}
			}//fim foreach
			}//fim if
	}//fim função
	
	
	
		
	/*########################################  Seleciona  ###############################################*/
	/**
	* Método responsável para Selecionar os usuarios
	* @param $banco STRING string com o nome do banco de dados
	* @param $campoSQL ARRAY array com o nome dos campos a serem selecionados
	* @param $campoCondicao STRING string com os nomes do banco a ser comparado na busca
	* @param $valorCondicao STRING string com o valor dos campos ser comparados
	* @param $ordem STRING string com a ordem a ser retornada pelo banco de dados
	**/
	
	
	public function seleciona($banco, $campoSQL, $campoCondicao, $valorCondicao, $operadorCondicao="=", $conectorCondicao="and", $ordem=""){
		
		if(!$banco){
			Throw new Exception ("Informe o banco de Dados!");
		}
		
		try{
			$db = db::singleton();
			$db->setJoin("");
			$db->setOrdem($ordem);
			$db->select($banco, $campoSQL, $campoCondicao, $valorCondicao, $operadorCondicao, $conectorCondicao);	
			$dados = $db->getResultado()->fetchAll();
			
			if($db->getNumLinhas() == 0){
				$msg ="Cadastro não encontrado!";
			}else{
				return $dados;
			}
		}catch(Exception $e){
			Throw new Exception ($msg);
		}//fim try
	
	
	}//fim função
	
	/*##############################################################################################################*/
	/**
	* Método responsável por deletar um usuario
	* @param $banco STRING string com o nome do banco de dados
	* @param $id STRING string do campo de comparação para exclusão
	* @param $idValor STRING string com o valor a ser comparado para exclusão
	**/
	
	
	public function deleta($banco, $id, $idValor){
	
		try{
			$db = db::singleton();
			$db->delete($banco, $id, $idValor);
		
		
		}catch (Excepetion $e){
			Throw new Exception ($e);
		}
		
	}
	
	/*##############################################################################################################*/
	
	/**
	* Método responsável por efetuar o login
	* @param $banco STRING string com o nome do banco de dados
	* @param $campoSQL ARRAY array com os nomes dos campos a serem alterados
	* @param $valorSQL ARRAY array valores a serem alterados no banco
	* @param $id STRING string com a descrição do campo a ser alterado
	* @param idAltera INT inteiro com o valor comparação
	**/
	
	
	public function altera($banco, $campoSQL, $valorSQL, $id, $idAltera){
			
			if(!$banco){
				Throw new Exception ("Selecione o banco de Dados!");
			}
				
			$db = db::singleton();
			
			try{
				
			$db->altera($banco, $campoSQL, $valorSQL, $id, $idAltera);
			
			
			}catch(Exception $e){
				Throw new Exception ("Erro ao alterar: ".$e);
			}
			 
	}//fim função
	

//////////////////////////////////////////////	Função para confirmar alteração de senha //////////////////////////////////

	public function confirmaMudSenha($svalor){
		
		//instancia classe para validação
		$val = validacao::singleton();
		//Verifica se o email é válido
		$val->validaEmail($svalor);
		
		//Pega data da alteração
		$data = date('Y-m-d');
		
		//email de envio da empresa
		$rem = "cesar@webprod.com.br";
		
		try{
			//envia o campo sql a ser comparado e o valor correspondente e verifica se a conta está ativa
			self::ativaConta("email", $svalor);
			
			//altera a informação para cadastro da data de solicitação
			$this->altera("usuario", "datasolic", $data, "email", $svalor);
			
			//busca as informações
			$ret = $this->seleciona("usuario", "id, email, idunico, datasolic", "email", $svalor);
			
			if(empty($ret)){
				Throw new Exception ("Falha ao encontrar o usuário");	
			}
			
			
			foreach($ret as $sql){
			
			//monta o link para retorno dos dados
			 $url = sprintf('id=%s&email=%s&uid=%s&key=%s', $sql->id, $sql->email, sha1($sql->idunico), sha1($sql->datasolic));
				
			}//fim foreach
			
			//junta a mensagem
			$msg = "Foi solicitado um lembrete de sua senha, siga os passos"."\n\n";
			$msg .= 'Clique no link abaixo para continuar o processo de '.utf8_decode('recuperação').' de sua senha:'."\n";
			$msg .= sprintf("http://www.webprod.com.br/usuario/reset.php?%s", $url);
			
			if(mail($svalor, $rem, $msg, "From: Cybersis Informatica")){
				$msn = true;	
			}else{
				$msn = false;
 				
			}
			
			
		}catch (Exception $e){
			
			if($msn === true){
				Throw new Exception("Mudança de senha concluida, cheque seu email!");
			}else{
				Throw new Exception("Sua conta não está ativada, caso não consiga ativá-la entre em contato conosco!");	
			}
		}//fim try
		
		
	}//fim função



	
/////////////////////////////////////////////	Função de Ateração da senha    ////////////////////////////////////////////
	
	/*
	* Método responsável por alterar a senha do usuario e enviar os dados por email
	* @param $svalor String string com o email do usuario
	*/
	public function recuperaDados($svalor){
		
		//email de quem enviou
		$sup = "contato@webprod.com.br";
		
		try{
			
			self::ativaConta("email", $svalor);
			
			$db = db::singleton();

     			$ret = $this->seleciona("usuario", "nome, email, usuario", "email", $svalor);
				
				if(empty($ret)){
					Throw new Exception ("Erro: email não cadastrado!");	
				}
				
		
				foreach($ret as $sql => $valor){
				
				$sen = rand();
				
				self::altera("usuario", "senha", md5($sen), "email", $svalor);
				
				$msg = utf8_decode("Sua senha foi alterada com sucesso, segue abaixo sua nova senha, caso necessite poderá trocá-la no painel de controle do usuário.")."\n";
				$msg .= "Nome: ".$valor->nome."\n";
				$msg .= "E-mail: ".$valor->email. "\n";
				$msg .= utf8_decode("Usuário: ").$valor->usuario. "\n";
				$msg .= "Senha: ".$sen. "\n\n\t";
				
				
        		// envia o email para o usuário referente a a troca de senha
				mail($valor->email, $sup, $msg, "From: Cybersis Informatica");
				}//fim Foreach
			
		}catch(Exception $e){
			
			Throw new Exception($e);	
		}
		
		
		
	}//fim função
	
}//fim classe


?>