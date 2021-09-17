<?php 
session_start();
include("../class/config.php");

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
        	
            
        </div> <!-- Fim meio conteudo -->
	</div><!-- Fim Meio -->
	<div id="rodape">
	 <?php include("../rodape.html"); ?>
  </div><!-- Fim Rodapé -->
</div><!-- Fim Geral -->
</body>
</html>
