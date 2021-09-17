<?php 

	class validacao{
	
	   private  static $instancia ; /// instância
	   private $arrayCPF = array(); // Variavel que guarda em um array os valores do CPF Usado na função validCPF
	   private $retorno = array(); // Variavel que realiza contas de loopings e outros.
		
		//Expressões Regulares de Validação
		private $telefone = "/(\([1-9]{2}\))([0-9]{4})-([0-9]{4})";
		private $all		= "/./";
		private $moeda	= "/([R$0-9]){1,50},([0-9]{2})/";
		
	  
  
  //metodo singleton()
   public static function singleton(){
      if(self::$instancia == null){
          self::$instancia = new self();

      }
      return self::$instancia;

   }
	
/////////////////////////////////////////////////   VALIDA STRING   //////////////////////////////////////////////////////

	public function validaString($svalor){
		
		$string = "/[A-Za-z0-9\.\-_]$/";
		
		$svalor = strip_tags(trim($svalor));
		$svalor = mysql_escape_string($svalor);
		
		
		if(preg_match($string, $svalor)){
					return true;
			  }else{
					Throw new Exception ("Você digitou caracteres inválidos!");  
			  }//Fim IF
		
	}



/////////////////////////////////////////////////   VALIDA EMAIL     ////////////////////////////////////////////////////
	public function validaEmail($vemail){
		
		$email 	= "/[[:alnum:]]\@[[:alnum:]]+(\.[[:alnum:]])+/";
		
		$mail = strip_tags(htmlentities(trim($vemail)));
		
		if(@preg_match($email, $mail)){
					return true;
			  }else{
					Throw new Exception ("Digite um email válido!");  
			  }//Fim IF
		
	}
		

//////////////////////////////////////////////          Valida CPF        ////////////////////////////////////////////////
		
		/**
		* Função Protected
		*@param String $dados string com os valores do cpf a ser validado
		**/
		public function validCPF($dados){
			
		//expressão regular
		
		$ecpf = "/([0-9]{3}\.){2}([0-9]{3})-([0-9]{2})/";
		
		if(@preg_match($cpf, $dados)){
					return true;
			  }else{
					Throw new Exception ("Digite um cpf válido!");  
		}//Fim IF
			
		//retira os . e - do cpf caso digitado
		$dados = str_replace(".", "", $dados);
		$dados = str_replace("-", "", $dados);
		
		try{
		//Verifica se são digitos numericos enviados.
		if(!is_numeric($dados)){
			Throw new Exception ("O CPF informado contem letras - Informe corretamente!");	
		}
			
		//Verifica se os Digitos são identicos sequenciais 1111111111
		
		for($i=0; $i <= 9; $i++){
			$dgtRepetido = "";
			
			if($dados == str_pad($dgtRepetido, 11, $i)){ //str_pad preenche até 11 digitos o numero informado por $i
				Throw new Exception("Este CPF é Invalido tente novamente!");
			 }//Fim IF
		}//fim for
			
		//print_r($dgtRepetido);
		//Pegando os Digitos Verificadores
		$digt = substr($dados, 9, 2);
		
		//Coloca todos os digitos do cpf em um array para posterior calculo de validação
		for($i=0; $i <= 8; $i++){
		  	$this->arrayCPF[$i] = substr($dados, $i, 1);
    	}//fim for
		
		//Efetuando o cáculo do primeiro Digito Verificador
		
		$pos = 10; // Valor para cálculo dos digitos Verificadores http://www.fundao.wiki.br/articles.asp?cod=23
		$soma = 0; //Aramazena a soma das operações abaixo
		
		for($i=0; $i<=8; $i++){
			
			$soma += $this->arrayCPF[$i] * $pos;
			$pos = $pos - 1;
			
		}//fim for
		
		$this->arrayCPF[9] = $soma % 11;
		
		if($this->arrayCPF[9] < 2 ){
			$this->arrayCPF[9] = 0;	
		}else{
			$this->arrayCPF[9] = 11 - $this->arrayCPF[9];	
		}
		

		/////////// Verifica o Ultimo digito verificador //////////////////
		
		$pos = 11;
		$soma = 0;// Reinicializa a variável
		
		for($i=0; $i <= 9; $i++){
			
			$soma += $this->arrayCPF[$i] * $pos;
			$pos = $pos - 1;
		
		}//Fim for
		
		$this->arrayCPF[10] = $soma % 11;
		
		if($this->arrayCPF[10] < 2){
			$this->arrayCPF[10] = 0;
		}else{
			$this->arrayCPF[10] = 11 - $this->arrayCPF[10];	
		}
		
		$dig = $this->arrayCPF[9] * 10 + $this->arrayCPF[10];
		
		if($dig != $digt){
			Throw new Exception ("Erro: Digite um CPF Valido!");	
		}//fim if	
		}catch(Exception $e){
			Throw new Exception ($e);	
		}
		
		}//Fim função validCPF
		
///////////////////////////////////////////////////////////////////////////////////////////////

	public function validData($data){
		
		$edata = "/([0-9]{4})-([0-9]{2})-([0-9]{2})/";
		
		if(@preg_match($edata, $data)){
					return true;
			  }else{
					Throw new Exception ("Digite uma data válida!");  
	   }//Fim IF
		
		//faz a troca de / por - para inserir no banco de dados
		$data = str_replace("/","-",$data);
		$data = explode("-", $data);
		$val = $data[2]."-".$data[1]."-".$data[0];
		return $val;
		
	}//fim função
	
	}//fim class
?>