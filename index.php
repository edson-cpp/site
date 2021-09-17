<?php

session_start();

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

$sessao = sessao::singleton(); 

if(isset($_POST['entra'])){

try{
$sessao->login($_POST['usuario'], $_POST['password']);
}catch (Exception $e){
	
	$msg = "<script language=\"javascript\">; alert('".$e->getMessage()."');</script>";
	
}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include("include/metaname.php"); ?>
<link href="css/css.css" rel="stylesheet" type="text/css" />
<link href="css/highslide.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="highslide/highslide-with-html.js"></script>
<script type="text/javascript">
    hs.graphicsDir = 'highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
</head>

<body class="Estrutura">

<img src=http://www.cybersis.com.br/cgi-bin/activate.cgi width=1 height=1 border=0>

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
        	<div class="propaganda">
            <!-- <div style="color:#000; text-align:center; font-weight:bolder; padding-top:6px;">Sistema emissor de Nota Fiscal Eletrônica. <br> O melhor sistema de gestão para atacadistas e distribuidores.</div> -->
            <div style="color:#003399; text-align:center; font-weight:bolder; padding-top:0px; font-size:26px">Praticidade e eficiência ao seu dispor</div> 
            <div style="color:#000; text-align:center; font-weight:bolder; padding-top:0px; font-size:14px">Sistema de gestão para atacadistas e distribuidores</div> 
            
            <div class="proptit"><span style="color:#FF0;">CGS Standard 1.0 disponível para download.</span><br /><span style="color:#FF0;">Pronto para o Windows 8.</span><br><a href="cgs/downloads.php" title="Clique para baixar!" style="font-size:15px; color:#FFF;">Faça o download agora clicando aqui.</a></div>
            <div style="text-align:center; position:absolute; margin-top:100px; color:#FF0; font-weight:bold; margin-left:340px;">Principais Características</div>
            <div style="position:absolute; width:150px; margin: 130px 0 0 460px; font-family:Verdana, Geneva, sans-serif; text-align:center;">
				<a href="/cgs/downloads.php" title="Baixe a versão de avaliação!" style="font-size:14.95px; color:#FFF; font-weight:bold;">Avalie por 30 Dias Gratuitamente!</a>
            </div>
			<div class="propmeio" style="padding-top:48px">  
			   - Controle Financeiro.<br />
			   - Controle de Estoque.<br />
			   - Cadastros Diversos.<br />
			   - Controle de Vendas e Compras.<br />
			   - Relatórios em Geral.<br />
			   <p style="padding-top:9px; padding-left:107px;"><a href="../cgs/index.php" title="Clique para mais informações" style="font-size:15px; color:#fff;">Saiba Mais...</a></p>
			</div>
			<div class="propBotao" style="padding-top:160px">
                <a href="cgs/comprar.php" title="Clique para comprar!" style="font-size:15px; color:#fff">Comprar!</a>
			</div>
			</div><!-- Fim Propaganda -->
            <!-- ######################################################################## SERVIÇOS ###################################################### --> 
             <span style="color:#006600; font-weight:bold;">Serviços</span>
             <hr style="border: #006600 1px solid; margin-top:-2px;" />
             
			<div class="servicos">
             	<div style="text-align:right; font-weight:bold; font-size:20px; padding-right:90px;">Manutenção de Computadores</div>
             	<div class="titserv">Seu computador parou de funcionar? Está Lento? Sua rede interna está travando?</div>
             	<div class="descManut">
				<a href="servicos/index.php" style="font-size:12px;" title="Clique aqui para conhecer!"> A Cybersis informática oferece a você que ja é nosso parceiro, e a você que nos visita, que reside em <b>Curitiba - PR</b> mais um serviço de qualidade <span style="color: #003399;"><b>Clique Aqui</b></span> e confira nossa proposta para sua <b>empresa</b> e também <b>residência</b>!</a><br>
				</div>
            	<div style="float:left; margin-top:10px; color:#990000; font-weight:bold; font-size:13px; text-align:center;">&nbsp;&nbsp;Você ja se perguntou quanto custa um funcionário parado por causa de um equipamento defeituoso?<br />&nbsp;&nbsp;Quanto custa um técnico registrado para cuidar de seus computadores?</div>
            </div>
            
             <!-- ######################################################################## UTILIDADES ###################################################### --> 
             <br />
             <span style="color: #006600; font-weight:bold;">Utilidades</span>
             <hr style="border: #006600 1px solid; margin-top:-2px;" /> 
           
           <div class="meioservicos" style="float:left; font-size:12px;">
           		 <div class="meioQuadTit">Serviços </div>
                 - Instalaç&atilde;o e configuração do sistema para emissão de Nota Fiscal Eletrônica e Cupom Fiscal. <br />
                 - Desenvolvimento de software desktop com integração total dos serviços internos da empresa.<br />
                 - Desenvolvimento Web - e-commerce. <br />
           </div>
           <div class="meioservicos" style="float:right;">
           		<div class="meioQuadTit">Utilidades</div>
                 
                 - <a href="util/escolha_software.pdf" target="_escsoft" class="menu">Aspectos mais relevantes para escolha de um Software de Gestão Empresarial.<br /></a>
                 - <a href="util/admin_tempo.pdf" target="_admtemp"  class="menu">Administração do Tempo.<br /></a>
                 - <a href="util/plan_estrat.pdf" target="_planest"  class="menu">Planejamento Estratégico.<br /></a>
                 - <a href="http://portal.pr.sebrae.com.br/feira2008/" target="_feiraemp"  class="menu">Leia mais: Feira do Empreendedor.</a><br />
                 - <a href="http://cybersis.com.br/down/icms/Calcula_icms_ST.zip" target="_feiraemp"  class="menu">Planilha de cálculo Icms ST</a><br />
                 
           </div>
           
        </div> <!-- Fim meio conteudo -->
	</div><!-- Fim Meio -->
	<div id="rodape">
	 <?php include("rodape.html"); ?>
  </div><!-- Fim Rodapé -->
</div><!-- Fim Geral -->
</body>
</html>
<?php print($msg); ?>