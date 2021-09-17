<?php
function truethemes_manage_javascripts_scripts(){
if (!is_admin()){
/*-----------------------------*/
/* Enqueue Styles
/*-----------------------------*/
//@since 4.0 - enqueue CSS
global $ttso;
$primary_style         =  $ttso->ka_main_scheme;
$secondary_style       =  $ttso->ka_secondary_scheme;
$mobile_style          =  $ttso->ka_responsive;
$tt_custom_primary     =  $ttso->ka_activate_custom_primary_color_scheme;
$tt_custom_secondary   =  $ttso->ka_activate_custom_secondary_color_scheme;

//default style.css
wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css');

//check for custom primary color scheme
if('true' == $tt_custom_primary):
function tt_custom_primary_head() {
	require_once(get_template_directory() . '/css/_custom_color_scheme_primary.php');
}
add_action('wp_head', 'tt_custom_primary_head');

else :
//else display default primary color scheme
wp_enqueue_style( 'primary-color', TRUETHEMES_CSS . $primary_style .'.css'); endif;

//check for custom secondary color scheme
if('true' == $tt_custom_secondary):
function tt_custom_secondary_head() {
	require_once(get_template_directory() . '/css/_custom_color_scheme_secondary.php');	
}
add_action('wp_head', 'tt_custom_secondary_head');

else:
//@since 4.0 - auto-include secondary style. removed CSS @import to improve site load speed.
//customer can use "Better Wordpress Minify" plugin to combine scripts. plugin works perfectly.
if('default' == $secondary_style) :
	$color_default = str_replace("karma-", "secondary-", $primary_style);
	wp_enqueue_style( 'secondary-color', TRUETHEMES_CSS . $color_default .'.css');
else:
	wp_enqueue_style( 'secondary-color', TRUETHEMES_CSS . $secondary_style .'.css');
endif;
endif; //end $tt_custom_secondary check
		
	wp_enqueue_style( 'fontawesome', TRUETHEMES_CSS .'_font-awesome.css');

if (class_exists('woocommerce')) :
	wp_enqueue_style( 'woocommerce', TRUETHEMES_CSS . '_woocommerce.css');
endif;

if('false' == $mobile_style) :
	wp_enqueue_style( 'mobile', TRUETHEMES_CSS . '_mobile.css');
endif;

	
/*-----------------------------------------------------------------*/
/* Grab Variables for localize custom-main.js
/*-----------------------------------------------------------------*/
//@since 4.0 - PHP Site Options variables for sliders and testimonial now passed directly into custom-main.js
//http://codex.wordpress.org/Function_Reference/wp_localize_script

$karma_jquery_slideshowSpeed     = $ttso->ka_karma_jquery_timeout;           // slide display time
$karma_jquery_pause_hover        = $ttso->ka_karma_jquery_pause_hover;       // pause jquery on hover?
$karma_jquery_randomize          = $ttso->ka_karma_jquery_randomize;         // randomize slides?
$karma_jquery_directionNav       = $ttso->ka_karma_jquery_directionNav;      // next-previous arrows
$karma_jquery_animation_effect   = $ttso->ka_karma_jquery_animation_effect;  // animation effect
$karma_jquery_animationSpeed     = $ttso->ka_karma_jquery_animationSpeed;    // animation speed
$testimonial_randomize           = $ttso->ka_testimonial_randomize;          // randomize slides?
$testimonial_directionNav        = $ttso->ka_testimonial_directionNav;       // next-previous arrows
$testimonial_animation_effect    = $ttso->ka_testimonial_animation_effect;   // animation effect
$testimonial_animationSpeed      = $ttso->ka_testimonial_animationSpeed;     // animation speed
$testimonial_slideshowSpeed      = $ttso->ka_testimonial_timeout;            // slide display time
$testimonial_pause_hover         = $ttso->ka_testimonial_pause_hover;        // pause on hover?
$mobile_menu_text                = $ttso->ka_mobile_menu_text;               // main menu - mobile version - text (ie. Main Menu)
$mobile_sub_menu_text            = $ttso->ka_mobile_sub_menu_text;           // sub menu - mobile version - dropdown text
$dragshare                       = $ttso->ka_dragshare;                      // drag-to-share check (bottom of file - not used in localize)
//$retina_logo                     = $ttso->ka_sitelogo_retina;                // if retina logo, load /js/retina.js

//pre-define retina logo for backward-compatible
if ('' == $retina_logo): 'no-retina' == $retina_logo; endif;

//set the data into array
$data = array(
'mobile_menu_text'                  => $mobile_menu_text,
'mobile_sub_menu_text'              => $mobile_sub_menu_text,
'karma_jquery_slideshowSpeed'       => $karma_jquery_slideshowSpeed,
'karma_jquery_pause_hover'          => $karma_jquery_pause_hover,
'karma_jquery_randomize'            => $karma_jquery_randomize,
'karma_jquery_directionNav'         => $karma_jquery_directionNav,
'karma_jquery_animation_effect'     => $karma_jquery_animation_effect,
'karma_jquery_animationSpeed'       => $karma_jquery_animationSpeed,
'testimonial_slideshowSpeed'        => $testimonial_slideshowSpeed,
'testimonial_pause_hover'           => $testimonial_pause_hover,
'testimonial_randomize'             => $testimonial_randomize,
'testimonial_directionNav'          => $testimonial_directionNav,
'testimonial_animation_effect'      => $testimonial_animation_effect,
'testimonial_animationSpeed'        => $testimonial_animationSpeed,
);

/*-----------------------------*/
/* Deregister Scripts
/*-----------------------------*/
wp_deregister_script('comment-reply');


/*-----------------------------*/
/* Enqueue Scripts
/*-----------------------------*/
//wp_register_script removed since 4.0 - only wp_enqueue_script is required
//anytime a script is updated simply use the current Karma version number for the script version number

wp_enqueue_script( 'jquery');
wp_enqueue_script( 'truethemes-custom', TRUETHEMES_JS .'/custom-main.js', array('jquery'),'4.0',$in_footer = true);
wp_enqueue_script( 'superfish', TRUETHEMES_JS .'/superfish.js', array('jquery'),'4.0',$in_footer = true);
wp_enqueue_script( 'flexslider', TRUETHEMES_JS .'/jquery.flexslider.js', array('jquery'),'4.0',$in_footer = true);
wp_enqueue_script( 'fitvids', TRUETHEMES_JS .'/jquery.fitvids.js', array('jquery'),'4.0',$in_footer = true);
wp_enqueue_script( 'isotope', TRUETHEMES_JS .'/jquery.isotope.js', array('jquery'),'4.0',$in_footer = true);
wp_enqueue_script( 'jquery-ui-core');
wp_enqueue_script( 'jquery-ui-widget');
wp_enqueue_script( 'jquery-ui-tabs');
wp_enqueue_script( 'jquery-ui-accordion');
wp_enqueue_script( 'pretty-photo', TRUETHEMES_JS .'/jquery.prettyPhoto.js', array('jquery'),'4.0',$in_footer = true);
wp_enqueue_script( 'comment-reply', site_url().'/wp-includes/js/comment-reply.js',$deps=null,'1.0',$in_footer = true);

/* if('' != $retina_logo):
wp_enqueue_script( 'retina', TRUETHEMES_JS .'/retina.js', array('jquery'),'4.0',$in_footer = true);
endif; */

//localize custom-main.js (must be placed after enqueue)
wp_localize_script('truethemes-custom', 'php_data', $data);




/*-----------------------------*/
/* WooCommerce Custom Enqueue
/*-----------------------------*/
//check for woocommerce
if (class_exists('woocommerce') && ((is_woocommerce() == "true") || (is_checkout() == "true") || (is_cart() == "true") || (is_account_page() == "true") )){

//de-regsiter unnecessary scripts
wp_deregister_script('comment-reply');
wp_deregister_script('jquery-easing');

//enqueue scripts
wp_enqueue_script('truethemes-woocommerce', TRUETHEMES_JS .'/custom-woocommerce.js', array('jquery'), '',$in_footer = true);
}
		
		
		
/*-----------------------------*/
/* Drag-to-Share
/*-----------------------------*/
//$dragshare comes from top of this file
if($dragshare == "true"):

//prettySociable Icons for wp_localize
define('PRETTYSOCIAL', get_template_directory_uri().'/images/_global/prettySociable/social_icons');
$pretty_delicious          = PRETTYSOCIAL.'/delicious.png';
$pretty_digg               = PRETTYSOCIAL.'/digg.png';
$pretty_facebook           = PRETTYSOCIAL.'/facebook.png';
$pretty_linkedin           = PRETTYSOCIAL.'/linkedin.png';
$pretty_reddit             = PRETTYSOCIAL.'/reddit.png';
$pretty_stumbleupon        = PRETTYSOCIAL.'/stumbleupon.png';
$pretty_tumblr             = PRETTYSOCIAL.'/tumblr.png';
$pretty_twitter            = PRETTYSOCIAL.'/twitter.png';

//set the data into array
$pretty_data = array(
'delicious'     => $pretty_delicious,
'digg'          => $pretty_digg,
'facebook'      => $pretty_facebook,
'linkedin'      => $pretty_linkedin,
'reddit'        => $pretty_reddit,
'stumbleupon'   => $pretty_stumbleupon,
'tumblr'        => $pretty_tumblr,
'twitter'       => $pretty_twitter,
);

//load prettySociable only in...
if(is_single()||is_home()||is_archive()||is_category()||is_tag()||is_author()):

//Bitly API script
wp_enqueue_script( 'bitly-api','http://bit.ly/javascript-api.js?version=latest&login=scaron&apiKey=R_6d2a7b26f3f521e79060a081e248770a', array('jquery'),'1.0',$in_footer = true);

wp_enqueue_script( 'pretty-sociable', TRUETHEMES_JS .'/jquery.prettySociable.js', array('jquery'),'1.2.1',$in_footer = true);

//localize prettySociable.js (must be placed after enqueue)		
wp_localize_script('pretty-sociable', 'social_data', $pretty_data);
		
endif; // if_single(), is_home()...
endif; // if($dragshare)		
}
}

//hook in last, so that plugins cannot change this? Maybe.
//hook in template redirect instead of init so that is_single() conditional tags works.
add_action('template_redirect', 'truethemes_manage_javascripts_scripts',90);
?>