<?php
/* --------------------------------- */
/* Custom functions                  */
/* --------------------------------- */

//insert custom functions here



/* ----------------------------------------------------- */
/* Do not touch code below this line - sky may fall      */
/* ----------------------------------------------------- */

//@since 4.0.1, codes for compatibility with Better WordPress Minify Plugin
function karma_bwm_style() {
	wp_enqueue_style( 'karma-style', get_stylesheet_uri() );
}

//Checks for activated Better WordPress Minify Plugin, before adding action.
if(function_exists('bwp_minify')){
add_action( 'wp_enqueue_scripts', 'karma_bwm_style' );
}

?>