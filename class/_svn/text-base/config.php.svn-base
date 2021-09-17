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


/**
funчуo para transformar a data de portugues para mysql  e vice-versa
@param Int $tipo = 0 -=> Transforma data dd-mm-aaaa para aaaa-mm-dd -=> data brasil for mysql
 1 -=> Transforma data aaaa-mm-dd para dd/mm/aaaa -=> mysql for data brasil
**/

function convdata($dataform, $tipo){
if ($tipo == 0) {
$datatrans = explode ("/", $dataform);
$data = "$datatrans[2]-$datatrans[1]-$datatrans[0]";
} elseif ($tipo == 1) {
$datatrans = explode ("-", $dataform);
$data = "$datatrans[2]/$datatrans[1]/$datatrans[0]";
}
return $data;
}

//Fun??o para datas atuais em extenso

// leitura das datas
$dia = date('d');
$mes = date('m');
$ano = date('Y');
$semana = date('w');


// configuraчуo mes

switch ($mes){

case 1: $mes = "JANEIRO"; break;
case 2: $mes = "FEVEREIRO"; break;
case 3: $mes = "MARЧO"; break;
case 4: $mes = "ABRIL"; break;
case 5: $mes = "MAIO"; break;
case 6: $mes = "JUNHO"; break;
case 7: $mes = "JULHO"; break;
case 8: $mes = "AGOSTO"; break;
case 9: $mes = "SETEMBRO"; break;
case 10: $mes = "OUTUBRO"; break;
case 11: $mes = "NOVEMBRO"; break;
case 12: $mes = "DEZEMBRO"; break;

}


// configuraчуo semana

switch ($semana) {

case 0: $semana = "DOMINGO"; break;
case 1: $semana = "SEGUNDA FEIRA"; break;
case 2: $semana = "TERЧA-FEIRA"; break;
case 3: $semana = "QUARTA-FEIRA"; break;
case 4: $semana = "QUINTA-FEIRA"; break;
case 5: $semana = "SEXTA-FEIRA"; break;
case 6: $semana = "SСBADO"; break;

}

sessao::valida_login();



?>