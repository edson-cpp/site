<?php 

	ini_set('display_errors', 0);
	define('SERVER_IP', '216.70.108.150');
	define('SERVER_THUMB_IP', '205.186.138.15');
	$cu3er_path = trailingslashit(dirname(__FILE__));
	$cu3er_messages = array(
		'noSWF' => '<div class="error">You are missing CU3ER.swf file. <a href="admin.php?page=CU3ERAddNew">Create</a> a project with using CU3ER zip project file or <a href="http:admin.php?page=CU3ERSetup">upload</a> <code>CU3ER.swf</code>.</div>',
		'noJS' => '<div class="error">Please upload <code>jquery.cu3er.js</code>.</div>',
		'noJSPlayer' => '<div class="error">Please upload <code>jquery.cu3er.player.js</code>.</div>',
		'setupSuccess' => '<div class="CU3ER-success updated below-h2" id="message"><p>Settings successfully saved.</p></div>',
		'success' => '<div class="CU3ER-success updated below-h2" id="message">CU3ER successfully saved.</div>',
		'successXML' => '<div class="CU3ER-success updated below-h2" id="message">New XML successfully saved.</div>',
		'error' => '<div class="error">Something went wrong, please try again.</div>',
		'version' => '<div class="error">wpCU3ER plugin requires WordPress 2.8 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a></div>',
		'duplicated' => '<div id="message" class="CU3ER-success updated below-h2">CU3ER is successfully duplicated.</div>',
		'notLatest' => '<div class="error">You are not using the latest version of <code>CU3ER.swf</code>. <a href="admin.php?page=CU3ERAddNew&update=1">Click here</a> to update automatically from http://getcu3er.com to the latest version.</div>',
		'notLatestJS' => '<div class="error">You are not using the latest version of <code>jquery.cu3er.js</code>. <a href="admin.php?page=CU3ERAddNew&update=1&js=1">Click here</a> to update automatically from http://getcu3er.com to the latest version.</div>',
		'notLatestJSPlayer' => '<div class="error">You are not using the latest version of <code>jquery.cu3er.player.js</code>. <a href="admin.php?page=CU3ERAddNew&update=1&js=1&player=1">Click here</a> to update automatically from http://getcu3er.com to the latest version.</div>',
		'oldXML' => '<div class="error">You are using old version of XML! Please edit your newly uploaded slideshow and correct General Settings > SWF Size.</div>',
		'notXML' => '<div class="error">Missing or incomplete XML file, please use correct CU3ER zip project archive. <a class="button" href="admin.php?page=CU3ERAddNew">Try again</a> </div>',
		'updated' => '<div id="message" class="CU3ER-success updated below-h2"><code>CU3ER.swf</code> has been updated.</div>',
		'updatedJS' => '<div id="message" class="CU3ER-success updated below-h2"><code>jquery.cu3er.js</code> has been updated.</div>',
		'updatedJSPlayer' => '<div id="message" class="CU3ER-success updated below-h2"><code>jquery.cu3er.player.js</code> has been updated.</div>',
		'notUpdated' => '<div class="error">Something went wrong. <code>CU3ER.swf</code> has NOT been updated. Probably due lack of permissions.</div>',
		'notUpdatedJS' => '<div class="error">Something went wrong. <code>jquery.cu3er.js</code> has NOT been updated. Probably due lack of permissions.</div>',
		'notUpdatedJSPlayer' => '<div class="error">Something went wrong. <code>jquery.cu3er.player.js</code> has NOT been updated. Probably due lack of permissions.</div>',
		'missingXML' => '<div class="error">Could not locate XML file. Check if XML file exist, or if it is readable to script.</div>',
		'curlNotIntalled' => '<div class="error">PHP extension <code>curl</code> is not installed. You may experience a lack of functionality.</div>',
		'xmlreaderNotIntalled' => '<div class="error">PHP extension <code>xmlreader</code> is not installed. You will <b>not</b> be able to import any projects. Please contact your hosting support to install <code>xmlreader</code> extension.</div>'
	);
	$cu3er_defaults = array(
		'duration' => 5,
		'fit' => 'default',
		'color' => '0x000000',
		'target' => '_blank',
		'dtarget' => '_self',
		'type' => '3D',
		'columns' => 5,
		'rows' => 5,
		'type2D' => 'fade',
		'flipAngle' => 180,
		'flipOrder' => 90,
		'flipShader' => 'plat',
		'flipOrderFromCenter' => 'false',
		'flipDirection' => 'right',
		'flipColor' => '0xff0000',
		'flipBoxDepth' => 500,
		'flipDepth' => 300,
		'flipEasing' => 'Sine.easeInOut',
		'flipDuration' => 0.8,
		'flipDelay' => 0.15,
		'flipDelayRandomize' => 0
	);

?>