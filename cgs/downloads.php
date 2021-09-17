<?php
$MajSB = "0"; //Versão maior CGS Small Business Workstation
$MinSB = "9"; //Versão menor CGS Small Business Workstation
$RevSB = "103"; //Revisão CGS Small Business Workstation
$MajSBSrv = "0"; //Versão maior CGS Small Business Server
$MinSBSrv = "2"; //Versão menor CGS Small Business Server
$RevSBSrv = "4"; //Revisão CGS Small Business Server
$MajSP = "0"; //Versão maior CGS Small Business Portable
$MinSP = "1"; //Versão menor CGS Small Business Portable
$RevSP = "13"; //Revisão CGS Small Business Portable
$MajSTD = "1"; //Versão maior CGS Standard Workstation
$MinSTD = "0"; //Versão menor CGS Standard Workstation
$RevSTD = "385"; //Revisão CGS Standard Workstation
$MajSTDSrv = "0"; //Versão maior CGS Standard Server
$MinSTDSrv = "4"; //Versão menor CGS Standard Server
$RevSTDSrv = "17"; //Revisão CGS Standard Server
$MajSTDP = "0"; //Versão maior CGS Standard Portable
$MinSTDP = "4"; //Versão menor CGS Standard Portable
$RevSTDP = "9"; //Revisão CGS Standard Portable
$MajEF = "0"; //Versão maior CGS ERP Free
$MinEF = "8"; //Versão menor CGS ERP Free
$RevEF = "5"; //Revisão CGS ERP Free
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
    	<div id="meioconteudo" style="font-size:13px;">
        	<div class="titus">Pacote de Instalação</div>
            
			<br>
            <span style="font-size:14px; font-weight:bold; color:#063;">Requisitos Mínimos</span>
         	<p>
				<b>Sistema suportado:</b> Windows 2K/03/08/XP/Vi/W7/W8. <br />
				<b>Requisitos:</b> Processador de 1000 MHz, 1024MB de memória Ram, 1024MB espaço em disco. <br />
				<b>Limitação de uso:</b> 30 Dias para versão Trial.<br>
            </p>
			
			<div style="float:left; padding-left:30px"><br>
            <?php print('<a href="http://www.cybersis.com.br/down/cgs/manual_inst_cgs.pdf" target="_top" title="Manual de Instalação">');?>
            <img src="../img/pdf.jpg" /></div><br><br>
            <div style="float:left; padding-left:10px; padding-right:15px; color:#070;"><br />
            <span style="font-size:40px; color:#070;">Manual de Instalação</span>
            </a>
            </div>

			<div><br><br><br><br><br><br><br><br></div>

            <div style="float:left; padding-left:30px;">
            <?php print('<a href="http://www.cybersis.com.br/cgstrial/CGS-Standard_Server.msi" target="_top" title="Download CGS Standard Server Trial v'.$MajSTDSrv.".".$MinSTDSrv.".".$RevSTDSrv.'">');?>
            <img src="../img/icodown.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>CGS Standard Server</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 10,00 MB<br>
            <b>Versão: <?php print($MajSTDSrv.".".$MinSTDSrv.".".$RevSTDSrv); ?></b><br>
            <span style="font-size:10px;">Sistema de Automação Comercial.</span>
            </a>
            </div>
          
            <div style="float:left;">
            <?php print('<a href="http://www.cybersis.com.br/cgstrial/CGS-Standard_Workstation.msi" target="_top" title="Download CGS Standard Workstation Trial v'.$MajSTD.".".$MinSTD.".".$RevSTD.'">');?>
            <img src="../img/icodown.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>CGS Standard Workstation</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 17,4 MB<br>
            <b>Versão: <?php print($MajSTD.".".$MinSTD.".".$RevSTD); ?></b><br>
            <span style="font-size:10px;">Sistema de Automação Comercial.</span>
            </a>
            </div>
			
			<div><br><br><br><br><br><br><br><br><br></div>
         	
            <div style="float:left; padding-left:30px;">
            <?php print('<a href="http://www.cybersis.com.br/cgstrial/CGS-Standard.zip" target="_top" title="Pack CGS Standard Server+Workstation+Portable+Manual">');?>
            <img src="../img/icozip.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>Pack CGS Standard - Server + Workstation + Portable + Manual</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 36,0 MB<br>
            <b>Versão Server: <?php print($MajSTDSrv.".".$MinSTDSrv.".".$RevSTDSrv); ?></b><br>
            <b>Versão Workstation: <?php print($MajSTD.".".$MinSTD.".".$RevSTD); ?></b><br>
            <b>Versão Portable: <?php print($MajSTDP.".".$MinSTDP.".".$RevSTDP); ?></b><br>
            </a>
            </div>
          			
			<div><br><br><br><br><br><br><br><br><br></div>
         	
            <div style="float:left; padding-left:30px;">
            <?php print('<a href="http://www.cybersis.com.br/cgstrial/CGS-Standard_Portable.msi" target="_top" title="Download CGS Standard Portable Trial v'.$MajSTDP.".".$MinSTDP.".".$RevSTDP.'">');?>
            <img src="../img/icodown.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>CGS Standard Portable</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 9,49 MB<br>
            <b>Versão: <?php print($MajSTDP.".".$MinSTDP.".".$RevSTDP); ?></b><br>
            <span style="font-size:10px;">Sistema de Automação Comercial.</span>
            </a>
            </div>

            <div style="float:left;">
            <?php print('<a href="http://www.cybersis.com.br/cgstrial/CGS-Small_Portable.msi" target="_top" title="Download CGS Small Business Portable Trial v'.$MajSP.".".$MinSP.".".$RevSP.'">');?>
            <img src="../img/icodown.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>CGS Small Business Portable</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 7,32 MB<br>
            <b>Versão: <?php print($MajSP.".".$MinSP.".".$RevSP); ?></b><br>
            <span style="font-size:10px;">Sistema de Automação Comercial.</span>
            </a>
            </div>

			<div><br><br><br><br><br><br><br><br><br></div>
         	
			<div style="float:left; padding-left:30px;">
            <?php print('<a href="http://www.cybersis.com.br/cgstrial/CGS-Small_Server.msi" target="_top" title="Download CGS Small Business Server Trial v'.$MajSBSrv.".".$MinSBSrv.".".$RevSBSrv.'">');?>
            <img src="../img/icodown.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>CGS Small Business Server</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 7,64 MB<br>
            <b>Versão: <?php print($MajSBSrv.".".$MinSBSrv.".".$RevSBSrv); ?></b><br>
            <span style="font-size:10px;">Sistema de Automação Comercial.</span>
            </a>
            </div>
          
         	<div style="float:left;">
            <?php print('<a href="http://www.cybersis.com.br/cgstrial/CGS-Small_Workstation.msi" target="_top" title="Download CGS Small Business Workstation Trial v'.$MajSB.".".$MinSB.".".$RevSB.'">');?>
            <img src="../img/icodown.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>CGS Small Business Workstation</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 12,6 MB<br>
            <b>Versão: <?php print($MajSB.".".$MinSB.".".$RevSB); ?></b><br>
            <span style="font-size:10px;">Sistema de Automação Comercial.</span>
            </a>
            </div>
                      
			<div><br><br><br><br><br><br><br><br><br></div>
         	
			<div style="float:left; padding-left:30px;">
            <?php print('<a href="http://cybersis.com.br/cgs/free/CGS_Free.msi" target="_top" title="Download CGS ERP Free v'.$MajEF.".".$MinEF.".".$RevEF.'">');?>
            <img src="../img/icodown.jpg" /></div>
            <div style="float:left; padding-left:10px; padding-right:15px;"><br />
			<b>CGS ERP Free</b><br>
			<b>Clique aqui para baixar.</b><br />
			<b>Tamanho:</b> 10,40 MB<br>
            <b>Versão: <?php print($MajEF.".".$MinEF.".".$RevEF); ?></b><br>
            <span style="font-size:10px;">Sistema de Automação Comercial Gratuito.</span>
            </a>
            </div>

            <div class="titus" style="margin-top:150px;">Ferramentas</div>
            <br /><br />
            
            <div style="float:left; width:150px; padding-right:60px; padding-left:20px; text-align:center;">
            <a href="http://downloads.sourceforge.net/sevenzip/7z465.exe" target="_blank">
            <img src="../img/7zip.png" title="Download 7-ZIP" /><br /><br />
            <b>Programa usado para descompressão de arquivos ZIP.</b><br /><br />
            </a>
            </div>
            
            <div style="float:left; width:150px; padding-right:60px; text-align:center;"><br>
            <a href="http://www.ammyy.com/AA_v3.2.exe" target="_blank">
            <img src="../img/ammyy_logo.png" title=" Dowload AA"/><br /><br><br>
            <b>AMMYY Admin<br />Ferramenta necessária para acesso remoto.</b>
            </a>
            </div>
            
            <div style="float:left; width:180px; text-align:center;">
            <a href="http://www.microsoft.com/downloads/thankyou.aspx?familyId=1cd6acf9-ce06-4e1c-8dcf-f33f669dbc3a&displayLang=pt-br" target="_blank">
            <img src="../img/Excel.png" title="Download XLViewer" /><br />
            <b>XLViewer<br />Software disponibilizado pela Microsoft para visualizar planilhas do Excel.</b>
            </a>
            </div>
            
            <div style="float:left; width:150px; padding-right:80px; text-align:center;"><br /><br />
            <a href="http://www.cybersis.com.br/down/mysql/mysql-connector-odbc-5.1.8-win32.msi" target="_top">
            <img src="../img/myodbc.png" title="Download MyODBC 5.1" /><br><br>
            <b>Programa usado para estabelecer conexão com servidor Cybersis.</b>
            </a>
            </div>

            <div style="float:left; width:150px; text-align:center;"><br><br>
            <a href="http://www.teamviewer.com/download/TeamViewer_Setup.exe" target="_blank">
            <img src="../img/teamviewer.png" title=" Dowload TeamViewer"/><br />
            <b>TeamViewer <br />Ferramenta necessária para acesso remoto.</b>
            </a><br><br>
            </div>
		</div> <!-- Fim meio conteudo -->
	</div><!-- Fim Meio -->
	<div id="rodape"><?php include("../rodape.html"); ?></div><!-- Fim Rodapé -->
</div><!-- Fim Geral -->
</body>
</html>
