<?php
/**
* @author Adilson Santos da Rocha
* @version 0.1
* Classe que manterá a conexão com o banco de dados e  proverá  alguns métodos para facilitar  a integração com o banco de dados
**/

class db {
   private  static $instancia ; /// instância
   public  $link; 	/// Objeto PDO conectado ao banco de Dados
   private $tipo_banco; /// tipo de banco de dados utilizado
   private $host ;	/// host do banco de dados
   private $usuario;	///usuario de conexao com o banco de dados
   private $senha;  	/// senha de conexao com o banco de dados
   private $banco; 	/// nome do banco de dados a ser utilizado
   private $sql;	/// Sql executada ou a ser executada pelo banco
   private $num_linhas;	/// Número de linhas retormadas pela sql executada
   private $ultimo_id;  /// Ultimo id gerado pela inserção
   private $resultado;	/// PDO statement ou seja o resultado de uma execução no  banco de dados
   private $erro;	/// status da execução do sql caso não houver erros será true
   private $ordem;	/// campos pelo qual será ordenada a consulta
   private $grupo;      /// campos de agruapamento
   private $limite;	/// define o limite  inicial dos registros a serem pesquisados em uma query SELECT
   private $limite_fim;	/// define o limite final para pesquisas no banco de dados


   /**
   * Inicializa as varíaveis de conexao com o banco e em seguida  faz a conexão com o banco
   **/

   private function __construct(){
        $this->tipo_banco  = "mysql";
        $this->host	   	   = "localhost";
        $this->usuario	   = "root";
        $this->senha 	   = "abc1235";
        $this->banco	   = "cybersis";
        $this->conecta();
   }

   /**
   *
   **/
   public static function singleton(){
      if(self::$instancia == null){
          self::$instancia = new self();

      }
      return self::$instancia;

   }


   private function monta_condicao($campos_condicao="",
                                   $campos_valores="",
                                   $operadores_condicao = "=",
                                   $conectores_condicao = "AND"){
       /**** montando as condições ***/

       if(is_array($campos_condicao)){
         $tam = sizeof($campos_condicao);

         for($i=0;$i < $tam ;$i++){

           if($i >0){
               if(is_array($conectores_condicao)){
                $condicao.= " ". $conectores_condicao[$i-1] ." " ;

               }// fim do if
               else{
                 $condicao.= " $conectores_condicao ";
               }// fim do else

           } //fim do if

           $condicao .= "$campos_condicao[$i] ";
           $condicao .= (is_array($operadores_condicao))?
           		      " $operadores_condicao[$i] ":
           		      " $operadores_condicao ";


           $condicao .="?";
        }// fim do for

          $this->sql .= " WHERE $condicao";

        }// fim do if
        else{
         if($campos_condicao != ""){
             $this->sql .= "  WHERE $campos_condicao  $operadores_condicao ? ";
         }//fim if
       }//fim else

   }// fim da função



   /**
   * Monta consultas SQL "selects" dinâmicas  conforme os parâmetros passados
   * @param String $tabela Nome da tabela onde será executada a query select
   * @param mixed $campos Array ou string contendo quais os campos serão retornados na  consulta padrão *;
   * @param mixed $campos_condicao Campos que serão utilizados para construir  as condições de consultas
   * @param mixed $campos_valores valores dos campos das condições
   * @param mixed $operadores_condicao operadores de comparação entre os campos e os valores padrão "="
   * @param mixed $conectores_condicao operadores lógicos entre as condições testadas, caso os campos_condicao e campos_valores seja um array esse parametro terá sempre um item a menos  padrão AND
   *
   **/

   public function select($tabela,
   			  $campos = "*",
   			  $campos_condicao="",
   			  $campos_valores="",
   			  $operadores_condicao = "=",
   			  $conectores_condicao = "AND"){

       /******** montando a string do campos ******/
       if(is_array($campos)){
   	  $tam = sizeof($campos);

    	  for($i = 0 ;$i<$tam ;$i++){

    	    @ $c.= ($i==($tam-1))? "$campos[$i] " : "$campos[$i] , ";

   	  }// fim do for

   	  $campos = $c;
   	}


       $this->sql = "SELECT $campos FROM  $tabela $this->join ";
       $this->monta_condicao($campos_condicao,
                             $campos_valores,
                             $operadores_condicao,
                             $conectores_condicao);


       // agrupando



       if($this->grupo !=""){
          $this->sql .= "  GROUP  BY  $this->ordem ";
       }



       // ordenando
       if($this->ordem !=""){
          $this->sql .= "  ORDER BY  $this->ordem ";
       }




       if($this->limite != ""){
         $this->sql .=  "  LIMIT $this->limite ";
         $this->sql.= ($this->limite_fim !="")?
                          " , $this->limite_fim":
                          "";

       }
		
		//print_r($this->sql);
		
       if(!is_array($campos_valores)){
         $campos_valores = array($campos_valores);
       }
       //executando
       try{
         $this->resultado = $this->link->prepare($this->sql);
         $this->resultado->execute($campos_valores);
         $this->resultado->setFetchMode(PDO::FETCH_OBJ);
        $this->num_linhas = $this->resultado->rowCount();
       }
       catch (PDOException $e){

         $this->gera_exception($e->getMessage());
       }



   } //fim da função

   /**
    * junta tabelas para realizar comparações
    * @param String $tabela mixed quais as tabelas que vão ser juntadas
    * @param String $condicao mixed condição para o filtro
    * @param String $limpa  limpa a varíavel join da classe
    * @param String $tipo_join tipo de join a ser feito INNER, OUTHER, LEFT, OUTHER LEFT
    **/
    function add_join($tabela,
                      $condicao,
                      $limpa=1,
                      $tipo_join="") {
      if($limpa ==1){
        $this->join = "";
      }

      $sql = " $tipo_join JOIN $tabela ON $condicao  ";
      $this->join .= $sql;
    }





   /**
   * Monta consultas SQL "deletes" dinâmicas  conforme os parâmetros passados
   * @param String $tabela Nome da tabela onde será executada a query select

   * @param mixed $campos_condicao Campos que serão utilizados para construir  as condições de consultas
   * @param mixed $campos_valores valores dos campos das condições
   * @param mixed $operadores_condicao operadores de comparação entre os campos e os valores padrão "="
   * @param mixed $conectores_condicao operadores lógicos entre as condições testadas, caso os campos_condicao e campos_valores seja um array esse parametro terá sempre um item a menos  padrão AND
   *
   **/

   public function delete($tabela,
      			  $campos_condicao="",
   			  $campos_valores="",
   			  $operadores_condicao = "=",
   			  $conectores_condicao = "AND"){


       $this->sql = "DELETE  FROM  $tabela";
       $this->monta_condicao($campos_condicao,
                             $campos_valores,
                             $operadores_condicao,
                             $conectores_condicao);


       //print $this->sql;
       /*** EXECUTANDO ****/
       try{
          $this->link->BeginTransaction();
          $this->resultado       = $this->link->prepare($this->sql);
          if(!is_array($campos_valores)){
              $campos_valores = array($campos_valores);
          }
          $this->linhas_afetadas = $this->resultado->execute($campos_valores);
          $this->link->commit();
       }

       catch (PDOException $e){
          $this->gera_exception($e->getMessage());
          $dbh->rollBack();


       }
    }// fim da funcao



   /**
   * Método para compor as query para inserção em tabelas
   * @param String $tabela nome da tabela para a inserção
   * @param array  $valores  valores que serão inseridos na tabela. Caso campos não seja Passado. Devem conter os valores para TODOS os campos da tabela e na ordem em que eles estiverem na tabela.
    @param array $campos dos quais os campos serão inseridos padrão ="";
   */

   public function insere($tabela,$valores,$campos=""){


   	if(is_array($campos)){
   	  $tam = sizeof($campos);
    	  $c ="(";
    	  for($i = 0 ;$i<$tam ;$i++){

    	    $c.= ($i==($tam-1))? "$campos[$i] " : "$campos[$i] , ";

   	  }// fim do for
   	  $c .= " )";

   	}

   	$tam = sizeof($valores);
    	$v ="(";
    	for($i = 0 ;$i<$tam ;$i++){
    	   $v.= ($i==($tam-1))? "?" : "?,";

   	}// fim do for
   	$v .= " )";

   	try {
   	   $this->link->BeginTransaction();
   	   $this->sql = "INSERT INTO $tabela $c VALUES $v";
   	   $this->resultado = $this->link->prepare($this->sql);
   	   $this->resultado->execute($valores);
   	   $this->ultimo_id = $this->link->lastInsertId();
   	   $this->link->commit();
   	 }
   	 catch (PDOException $e){
   	   $this->gera_exception("Erro ao Inserir:".$e->getMessage());
   	   $this->link->rollBack();

   	 }


    }// fim da função



   /**
   * Monta consultas SQL "Updates" dinâmicas  conforme os parâmetros passados
   * @param String $tabela Nome da tabela onde será executada a query update
   * @param mixed $campos Array ou string contendo quais os campos serão alterados na ;
   * @param mixed $valores Array ou string contendo os valores para os campos alterados
   * @param mixed $campos_condicao Campos que serão utilizados para construir  as condições de consultas
   * @param mixed $campos_valores valores dos campos das condições
   * @param mixed $operadores_condicao operadores de comparação entre os campos e os valores padrão "="
   * @param mixed $conectores_condicao operadores lógicos entre as condições testadas, caso os campos_condicao e campos_valores seja um array esse parametro terá sempre um item a menos  padrão AND
   *
   **/


    function altera($tabela,
                    $campos,
                    $valores,
                    $campos_condicao="",
                    $campos_valores="",
                    $operadores_condicao = "=",
                    $conectores_condicao = "AND"){

     $this->sql= "UPDATE $tabela SET ";


     if(is_array($campos)){
        $tam = sizeof($campos);
      
        for($i=0;$i<$tam;$i++){
         $this->sql.=($i==($tam-1))?" $campos[$i] = ? " :
          		   	    " $campos[$i] = ?,";

        }

     }
     else{
        $this->sql.= "$campos = ?";
        $valores = array($valores);

     }
     $this->monta_condicao($campos_condicao,
                             $campos_valores,
                             $operadores_condicao,
                             $conectores_condicao);


     $campos_valores = (is_array($campos_valores))?$campos_valores:array($campos_valores);
     $valores = array_merge($valores,$campos_valores);
	// print_r($valores);
	 //print($this->sql);

     /*** EXECUTANDO ****/
     try {
   	   $this->link->BeginTransaction();
   	   $this->resultado = $this->link->prepare($this->sql);
   	   $this->linhas_afetadas = $this->resultado->execute($valores);
   	   $this->link->commit();
   	 }
   	 catch (PDOException $e){
   	   $this->gera_exception($e->getMessage());
   	   $this->link->rollBack();

   	 }



   }//fim da função


   /**
   * Método mágico _call utilizado para implementar metodos não existentes na classe Gets e Sets. Por padrao o php chama esse metodod tada vez eu um metodo não existente na classe é chamdao
   * @param String $metod nome do metodo inesistente chamado
   * @param Array $parametros um array contendo todos os parametros da chamado ada função
   **/

   function __call($metod,$parametros){
     //print "Metodo chamado $metod";
     $metodo = substr($metod,0,3);
     $variavel = substr($metod,3);

     $variavel = substr(strtolower(preg_replace('/([a-z])([A-Z])/', "$1_$2", $variavel)), 0);

     $var_protegidas =  array('host','usuario','senha','banco','tipo_banco');
     if(in_array($variavel,$var_protegidas)){
         return;

     }

     if($metodo =="Get" || $metodo =="get"){

       return $this->$variavel;
     }
     if ($metodo == "Set" || $metodo == "set"){

//
         $this->$variavel = $parametros[0];


     } // fim classe "__call"



   }

   /**
   * Gera exeption para tratamento de erro da classe
   **/
   private function gera_exception($erro){
     throw  new Exception ("<pre>Erro ao  Executar a sql: $this->sql \n Erro retonado no banco:\n".$erro);

   }


   /**
   * método que encerra a conexao por timeout obsoleta com PDO
   **/

  /* function __sleep(){
       $this->desconecta();

   }*/

   /**
   * metodo que retoma a conexao por ativação em timeout Obsoleta com PDo
   **/


  /* function __wakeup(){
       $this->conecta();

   }*/


   /**
   * Baseada nas variáveis de conexao $this->host, $this->usuario e $this->senha conecta ao banco de dodos
   **/

   private  function conecta(){
       try{
          $this->link =  new PDO("$this->tipo_banco:host=$this->host;dbname=$this->banco",$this->usuario,$this->senha);
          $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e){
              throw  new Exception ("Erro Ao conectar-se ao Banco de dados \n Menssagem:" .$e->getMessage());
        
        }


   }// fim da funcao


   /**
   * metodo que encerra a conexao com o banco
   **/

    private function desconecta(){
       $this->link = null;


    }// fim function


    /**
    * Fecha a conexao com o banco de dados por destruição da variavel de  instância
    **/

     function __destruct(){
       $this->desconecta();

    }


}// fim da classe