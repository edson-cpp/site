<?php
	
	class pesquisa {
		
		/**
		* @name Class Produto
		* @author Cesar Francisco Bueno
		* @version 0.0.2
		* Classe responsável pela inserção Alteração e Exclusão de Produtos
		**/
		
		private static $instancia;		
		
		function __construct(){
		
		}
		
		/**
		* metodo singleton responsável pela geração de objetos da classe garantindo  que apenas um objeto da classe * seja instanciado por  no programa
		**/
		
		public static function singleton() {
		  if(self::$instancia == null){
		     self::$instancia = new self();
		  }
		  
		  return self::$instancia;
		}
		
		/**
		* Método responsável por inserções de produtos
		* @param $campoSQL Array array com os campos a serem inserido dados
		* @param $valorSQL ARRAY array com os valores da pesquisa
		* @param $data DATE data de registro da pesquisa
		* @param $banco STRING string com o nome do banco de dados
		**/
		public function cadPesquisa($campoSQL, $valorSQL, $banco){
						
		for($i=0; $i < sizeof($valorSQL); $i++){
			if(!$valorSQL[1]) {
			   throw new Exception ("Digite o RAMO ATIVIDADE de sua empresa!");
			}
			

			if(!$valorSQL[2]) {
			   throw new Exception ("Digite o ESTADO em que se localiza sua empresa!");
			}
		}//fimfor			
	
			$db = db::singleton();
			
			try {
			
				$db->insere($banco, $valorSQL, $campoSQL);
				
			}
			catch (Exception $e){
				throw new Exception ($e);
			}
					   
		}//fim função
				
		
		/**
		* Método responsável pela alteração do produtos inseridos
		* @param $prod_id INT inteiro id do produto no banco de dados
		* @param $prod_nome STRING string nome do produto
		* @param $prod_quant INT quantidade do produto
		* @param $prod_valor DECIMAL valor numérico do produto
		* @param $prod_data DATE data de venda / alteração
		* @param $prod_bd STRING nome do banco a ser alterado
		**/

	/**
	* Método responsável por efetuar a busca dos dados 
	* @param $campoSQL STRING string com o nome do campo
	* @param $valorSQL STRING string com o valor de procura 
	* @param $idProcura INT int com o id para procura
	* @param $banco STRING string string com o nome do banco de dados
	**/
	public function seleciona($banco, $campoSQL, $valorSQL, $idProcura, $ordem){
			
	if(!$banco){
		throw new Exception ("Especifique o Banco de Dados!");
	}
	
	if(!$campoSQL){
		throw new Exception ("Especifique os campos de pesquisa da base de dados!");
	}
	

	$db = db::singleton();
	$db->setJoin("");
	$db->setOrdem($ordem);
	$db->select($banco, $campoSQL, $idProcura, $valorSQL);
	$dados =  $db->getResultado()->FetchAll();	
	return $dados;		
		
	}//fim função
	
	/**
	* Método responsável por efetuar a busca dos dados 
	* @param $bd STRING string com o nome do banco de dados
	* @param $camp_prod STRING string com o nome do campo
	* @param $val_prod STRING string com o valor de procura
	* @param $id_prod INT int para busca no banco de dados default sem valor
	**/
	
		public function cad_copias($prod_nome, $prod_tipo, $prod_quant,	$prod_valor, $prod_data, $prod_bd){
						
			if(!$prod_nome) {
			   throw new Exception ("Marque o produto correspondente a venda!");
			}
			
			if(!$prod_valor) {
			   throw new Exception ("Digite o valor do(s) produto(s).");
			}
			
			if(!$prod_data){
			   throw new Exception ("Coloque a data do registro.");
			}				
			
			
			$db = db::singleton();
			
			try {
			
				$campos = array('copia', 'tipo', 'quantidade', 'valor', 'data');
				$valores = array($prod_nome, $prod_tipo, $prod_quant, $prod_valor, $prod_data);
				$db->insere($prod_bd, $valores, $campos);
				
			}
			catch (Exception $e){
				throw new Exception ($e);
			}
					   
		}//fim função

		
		public function cad_papel($prod_valor,
								$prod_data,
								$prod_bd){
						
			
			if(!$prod_valor) {
			   throw new Exception ("Digite o valor do(s) produto(s).");
			}
			
			if(!$prod_data){
			   throw new Exception ("Coloque a data do registro.");
			}				
			
			
			$db = db::singleton();
			
			try {
			
				$campos = array('valor', 'data');
				$valores = array($prod_valor, $prod_data);
				$db->insere($prod_bd, $valores, $campos);
				
			}
			catch (Exception $e){
				throw new Exception ($e);
			}
					   
		}//fim função
		
		public function cad_telefonia($prod_prod,
									$prod_valor,
									$prod_data,
									$prod_bd){
						
			
			if(!$prod_valor) {
			   throw new Exception ("Digite o valor do(s) produto(s).");
			}
			
			if(!$prod_data){
			   throw new Exception ("Coloque a data do registro.");
			}				
			
			
			$db = db::singleton();
			
			try {
			
				$campos = array('produto', 'valor', 'data');
				$valores = array($prod_prod, $prod_valor, $prod_data);
				$db->insere($prod_bd, $valores, $campos);
				
			}
			catch (Exception $e){
				throw new Exception ($e);
			}
					   
		}//fim função
		
		
		//Cadastra os dados da página cash.php
		public function cad_cash($bd,
		                         $valor,
								 $data){
								 
			if(!$valor){
			 throw new Exception ("Digite um valor!");
			}				
								 
		 //instancia a classe do banco
		 
		 $db = db::singleton();
		 
		 try{
		 $campos = array('valor', 'data');
		 $valores = array($valor, $data);
		 $db->insere($bd, $valores, $campos);
		 
		 }catch(Exception $e){
		 	throw new Exception ($e);
		 }
		
		}//fim função
		
		
}	
						 

?>