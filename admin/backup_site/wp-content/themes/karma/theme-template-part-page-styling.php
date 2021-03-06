<?php
// Check for custom page styling options

// grab the color scheme settings
$page_custom_primary   = get_post_meta($post->ID,'page_primary_color_scheme',true);
$page_custom_secondary = get_post_meta($post->ID,'page_secondary_color_scheme',true);

// print the custom primary stylesheet
if ($page_custom_primary != "" && $page_custom_primary !== 'null'){
echo '<link href="'. TRUETHEMES_CSS . $page_custom_primary .'" rel="stylesheet" media="screen" />'."\n";
}

//print the custom secondary stylesheet
if ($page_custom_secondary != "" && $page_custom_secondary !=='null'){
echo '<link href="'. TRUETHEMES_CSS . $page_custom_secondary .'" rel="stylesheet" media="screen" />'."\n";
}

// grab the page background settings
$page_background_color    = get_post_meta($post->ID,'page_background_color',true);
$page_background_image    = get_post_meta($post->ID,'page_background_image',true);
$page_background_repeat   = get_post_meta($post->ID,'page_background_repeat',true);
$page_background_position = get_post_meta($post->ID,'page_background_position',true);
$page_background_fixed    = get_post_meta($post->ID,'truethemes_page_background_fixed',true);

// print the CSS for page backgrounds
if(!isset($css_array_perpage)){
$css_array_perpage = array();
}

//There is a hex value without number in post meta if user does not select background color.
//In PHP, the string length will be zero for one character, therefore we make sure it is more than zero before we should it.
$string_length = strlen($page_background_color);
if($string_length > 1){
	$page_background_color_code = 'background-color:'.$page_background_color.' !important;';
	array_push($css_array_perpage,$page_background_color_code);	
}

if($page_background_image != ""){
	$page_background_image_code = 'background-image:url('.$page_background_image.') !important;';
	array_push($css_array_perpage,$page_background_image_code);	
}

if($page_background_image != ""){
	$page_background_repeat_code = 'background-repeat:'.$page_background_repeat.' !important;';
	array_push($css_array_perpage,$page_background_repeat_code);	
}

if($page_background_image != ""){
	$page_background_position_code = 'background-position:'.$page_background_position.' !important;';
	array_push($css_array_perpage,$page_background_position_code);	
}

if("on" == $page_background_fixed){
	$page_background_fixed_code = 'background-attachment: fixed !important;';
	array_push($css_array_perpage,$page_background_fixed_code);	
}
	

if(!empty($css_array_perpage)){
	  echo "<!-- styles generated by custom page styling options -->\n";
	  echo"<style type='text/css'>\n";
	  echo"body {";
	        foreach($css_array_perpage as $css_item_perpage){
	         echo $css_item_perpage." ";	        
	        }
	  echo"}</style>\n";
	}

?>