<?php
/*------------------------------------------------*/
/* Custom CSS Output */
/*------------------------------------------------*/
/*
* function to push in custom font type.
* for use in truethemes_settings_css()
* @since version 2.6 development
* @param string $option_value, option value from database
* @paran string $css_code, for custom css font code
*/
function truethemes_push_custom_font($option_value,$css_code){
global $css_array;
global $css_link_container;
$google_font_types = array(
'Droid+Sans',
'Cabin',
'Cantarell',
'Cuprum',
'Oswald',
'Neuton',
'Orbitron',
'Arvo',
'Kreon',
'Indie+Flower',
'Josefin Sans'
);

if( ($option_value != 'nofont' && $option_value != '')){
$custom_logo_font_link = '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family='.$option_value.'" />'."\n";	
$custom_logo_font_code = $css_code;			
//check if font is google font, if yes, we provide font link
if(in_array($option_value,$google_font_types)){

if(!in_array($custom_logo_font_link,$css_link_container)){
//check if already in link container, if not then we add the css link.
array_push($css_link_container,$custom_logo_font_link);
}

}

array_push($css_array,$custom_logo_font_code);
}

}

/*
*  set global css array and css link container
*  for use in truethemes_setting_css() and truethemes_push_custom_css
*  @since version 2.6 development
*/

if(!isset($css_array)){
$css_array = array();
}

if(!isset($css_link_container)){
$css_link_container = array();
}

function truethemes_settings_css(){
//modified version 2.6 development

global $css_array;
global $css_link_container;

//get all css settings
//htmlspecialchars_decode and stripslashes function added in version 3.0.2 to prevent sanitize of custom css codes!
global $ttso;
$custom_css           = htmlspecialchars_decode(stripslashes($ttso->ka_custom_css),ENT_QUOTES);
$dropdown_css         = $ttso->ka_dropdown;
$nav_description      = $ttso->ka_nav_description;
$google_font          = $ttso->ka_google_font;
$custom_google_font   = $ttso->ka_custom_google_font;
$blog_image_frame     = $ttso->ka_blog_image_frame;
$responsive           = $ttso->ka_responsive;
$mobile_menu_subs     = $ttso->ka_mobile_menu_subs;
$ubermenu             = $ttso->ka_ubermenu;

//theme designer settings
$boxedlayout                              = $ttso->ka_boxedlayout;
$boxedlayout_shadow                       = $ttso->ka_boxedlayout_shadow;
$body_bg_color                            = $ttso->ka_body_bg_color;
$body_bg_image                            = $ttso->ka_body_bg_image;
$body_bg_image_select                     = $ttso->ka_select_body_bg;
$body_designer_page_background_position   = $ttso->ka_designer_page_background_position;
$body_designer_page_background_repeat     = $ttso->ka_designer_page_background_repeat;
$body_designer_page_background_fixed      = $ttso->ka_designer_page_background_fixed;
$div_main_custom_color                    = $ttso->ka_div_main_custom_color;
$content_separator_dark                   = $ttso->ka_content_separator_dark;
$content_separator_light                  = $ttso->ka_content_separator_light;
$content_gradient_disable                 = $ttso->ka_true_content_gradient;
$header_transparent_overlay               = $ttso->ka_header_transparent_overlay;
$footer_transparent_overlay               = $ttso->ka_footer_transparent_overlay;
$footer_callout_linkhover                 = $ttso->ka_footer_callout_link_hover_bg;
$footer_callout_main_bg                   = $ttso->ka_footer_callout_main_bg;
$header_transparent_overlay_upload        = $ttso->ka_header_transparent_overlay_upload;
$footer_transparent_overlay_upload        = $ttso->ka_footer_transparent_overlay_upload;
$header_height_adjust                     = $ttso->ka_header_height_adjust;
$font_kit_modern                          = $ttso->ka_font_kit_modern;
$font_kit_serif                           = $ttso->ka_font_kit_serif;
$font_kit_organic                         = $ttso->ka_font_kit_organic;
$jquery3_transparent_overlay              = $ttso->ka_jquery3_transparent_overlay;
$retina_logo                              = $ttso->ka_sitelogo_retina;
$sitelogo_width                           = $ttso->ka_sitelogo_width;
$sitelogo_height                          = $ttso->ka_sitelogo_height;



//@since 4.0 pre-define for backward-compatibility
if('' == $header_transparent_overlay): 'overlay-rays.png' == $header_transparent_overlay; endif; //maintain "rays" image
if('' == $footer_transparent_overlay): 'overlay-none'     == $footer_transparent_overlay; endif;


//push in css if not empty from setting
//custom css
if(!empty($custom_css)){
array_push($css_array,$custom_css);
}

$retina_logo_code = '
#header .tt-retina-logo {
	width: '.$sitelogo_width .';
 	height: '.$sitelogo_height.';
  	url: "'.$retina_logo.'";
}
';
array_push($css_array,$retina_logo_code);

//main navigation - dropdown
if($dropdown_css!='false'){
$drop_css_code = '#menu-main-nav li .drop {display:none !important;}
#menu-main-nav li.parent:hover {background:transparent url('.get_template_directory_uri().'/images/_global/seperator-main-nav.png) 0 50% no-repeat !important;}
#menu-main-nav li {padding: 3px 31px 5px 13px;}
#menu-main-nav li.parent,
#menu-main-nav li.parent:hover{padding: 3px 31px 5px 13px !important;}
.ie7 .big-banner #menu-main-nav {margin-bottom:16px;}';
array_push($css_array,$drop_css_code);	
}

//main navigation - descriptions
if($nav_description!= 'false'){
$nav_css_code = '#menu-main-nav a span.navi-description{display:none;}
#menu-main-nav a:hover {opacity:0.6;}
#menu-main-nav .drop a:hover {opacity:1.0;}
#menu-main-nav li strong {height:40px;}
#menu-main-nav .drop {top: 38px;}
#menu-main-nav {margin-top:12px;}
.ie7 .big-banner #menu-main-nav {margin-bottom:16px;}
#menu-main-nav li {padding-right:20px !important;}
#menu-main-nav li:before {height:0;background:none;}';
array_push($css_array,$nav_css_code);
}	

if($dropdown_css != 'false' && $nav_description != 'false'){
$nav_com_css = '#menu-main-nav li {background:none !important;padding-right:20px !important;}
#menu-main-nav a:hover {opacity:0.6;}
#menu-main-nav li.parent:hover{background: none !important;}
#menu-main-nav li.parent,
#menu-main-nav li.parent:hover{background:none !important;padding-right:20px !important;}';
array_push($css_array,$nav_com_css);		
}

//responsive css
if('true' == $responsive ){
$responsive_css_code = '#tt-mobile-menu-wrap, #tt-mobile-menu-button {display:none !important;}';
array_push($css_array,$responsive_css_code);	
}

//mobile menu sub pages
if('true' == $mobile_menu_subs ){
$mobile_menu_subs_css_code = '#tt-mobile-menu-list ul {display:none !important;}';
array_push($css_array,$mobile_menu_subs_css_code);	
}

//google font css
if( ($google_font != 'nofont' && $custom_google_font == '')){
$google_font_link = '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family='.$google_font.'" />'."\n";	
$google_font_code = 'h1, h2, h3, h4, h5 #main .comment-title, .four_o_four, .callout-wrap span, .search-title,.callout2, .comment-author-about, .logo-text {font-family:\''.$google_font.'\', Arial, sans-serif;}'."\n";
array_push($css_link_container,$google_font_link);
array_push($css_array,$google_font_code);
}

if($custom_google_font != ''){

//remove space and add + sign if there is space found in user entered custom font name.
//the google font name in css link has a plus sign.
$custom_google_font_name = str_replace(" ","+",$custom_google_font); 
$google_custom_link =  '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family='.$custom_google_font_name.'">'."\n";	

$sanitize = array('+','-'); //some font name have plus parameter, such as Special+Elite
// remove the plus and add space to custom font name, if there is a plus between the font name.
$sanitized_google_font_name = str_replace($sanitize,' ',$custom_google_font);
//the google font name in css item, does not have plus sign and needs a space.

$google_custom_font_code = 'h1, h2, h3, h4, h5 #main .comment-title, .four_o_four, .callout-wrap span, .search-title,.callout2, .comment-author-about, .logo-text {font-family:\''.$sanitized_google_font_name.'\', Arial, sans-serif;}'."\n";
array_push($css_link_container,$google_custom_link);
array_push($css_array,$google_custom_font_code);			
}

//blog shadow frame
if('shadow' == $blog_image_frame){
$nav_com_css = '.post_thumb {background-position: 0 -396px;}.post_thumb img {margin: 6px 0 0 6px;}';
array_push($css_array,$nav_com_css);		
}

/*--------------------------------------------------------------------*/
/* UberMenu */
/*--------------------------------------------------------------------*/

//ubermenu plugin styles
if('true' == $ubermenu ){
$ubermenu_css_code = '
#megaMenu {background: none;}
#megaMenu.megaMenuHorizontal ul.megaMenu > li.menu-item > a, #megaMenu.megaMenuHorizontal ul.megaMenu > li.menu-item > span.um-anchoremulator {border-left: none;}
#uber-menu-nav {margin-top: 8px;}
#megaMenu ul.megaMenu > li.menu-item > a span.wpmega-link-title, #megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator span.wpmega-link-title {letter-spacing: 0.6px;font-size:12.3px;}
#megaMenu ul.megaMenu > li.menu-item:hover > a, #megaMenu ul.megaMenu > li.menu-item > a:hover, #megaMenu ul.megaMenu > li.menu-item.megaHover > a, #megaMenu ul.megaMenu > li.menu-item:hover > span.um-anchoremulator, #megaMenu ul.megaMenu > li.menu-item > span.um-anchoremulator:hover, #megaMenu ul.megaMenu > li.menu-item.megaHover > span.um-anchoremulator {background: rgba(0,0,0,0.25);-webkit-border-top-left-radius: 3px;-webkit-border-top-right-radius: 3px;-moz-border-radius-topleft: 3px;-moz-border-radius-topright: 3px;border-top-left-radius: 3px;border-top-right-radius: 3px;}
';
array_push($css_array,$ubermenu_css_code);	
}


/*--------------------------------------------------------------------*/
/* Theme Designer */
/*--------------------------------------------------------------------*/

//content area - custom bg color
if('' != $div_main_custom_color ){
$main_custom_color_css_code = '
#main, #footer-top, .content-custom-bg .heading-horizontal span {background-color:'.$div_main_custom_color.';}.tools .breadcrumb .current_crumb:after { color: '.$div_main_custom_color.';}';
array_push($css_array,$main_custom_color_css_code);	
}

//content area - custom bg color - separator lines
if('' != $content_separator_dark ){
$content_separator_css_code = '
.content-custom-bg .callout-wrap,
.content-custom-bg .post_footer {
	border-top: 1px solid '.$content_separator_light.';
	border-bottom: 1px solid '.$content_separator_light.';
}

.content-style-tan .heading-horizontal:before {
	border-top: 1px solid '.$content_separator_dark.';
	border-bottom: 1px solid '.$content_separator_light.';
}

.content-custom-bg .hr,
.content-custom-bg .hr_top_link {
	border-top: 1px solid '.$content_separator_light.';
}

.content-custom-bg .callout-wrap:before,
.content-custom-bg .post_footer:before,
.content-custom-bg .hr:before,
.content-custom-bg .hr_top_link:before {
   border-top: 1px solid '.$content_separator_dark.';
}

.content-custom-bg .callout-wrap:after,
.content-custom-bg .post_footer:after,
.content-custom-bg #horizontal_nav:after,
.content-custom-bg .member-wrap:after {
   border-bottom: 1px solid '.$content_separator_dark.';
}

.content-custom-bg #horizontal_nav,
.content-custom-bg .sidebar-widget,
.content-custom-bg #sub_nav ul a,
.content-custom-bg .member-wrap {
	border-bottom: 1px solid '.$content_separator_light.';
}

.content-custom-bg #sidebar {
	border-left: 1px solid '.$content_separator_dark.';
}

.content-custom-bg #sidebar:before {
   border-left: 1px solid '.$content_separator_light.';
}

.content-custom-bg #sidebar.left_sidebar {
	border-right: 1px solid '.$content_separator_light.';
	
}

.content-custom-bg #sidebar.left_sidebar:after {
   border-right: 1px solid '.$content_separator_dark.';
}

.content-custom-bg #sidebar.left_sidebar,
.content-custom-bg #sidebar.left_sidebar:before {
	border-left: none;	
}

.content-custom-bg .sidebar-widget:after,
.content-custom-bg #sub_nav ul a:after {
   border-bottom: 1px solid '.$content_separator_dark.';
}

#sub_nav ul a:hover,
#sub_nav ul a:hover:after {
	border-color: transparent;
}';
array_push($css_array,$content_separator_css_code);	
}

//content area - gradient disable
if('true' == $content_gradient_disable) {
$content_gradient_disable_code = '
	div#main,
	div#footer-top {background-image: none;}';
array_push($css_array,$content_gradient_disable_code);
}

//header - transparent overlay - custom upload
if('' != $header_transparent_overlay_upload) {
$header_transparent_overlay_upload_code = '
.header-overlay {
	background: url('.$header_transparent_overlay_upload.') 50% 50% no-repeat;
}';
array_push($css_array,$header_transparent_overlay_upload_code);
}

//header - transparent overlay
if ('overlay-none' != $header_transparent_overlay) {
$header_transparent_overlay_code = '
.header-overlay {
	background: url('.get_template_directory_uri().'/images/_global/'.$header_transparent_overlay.') 50% 50% no-repeat;
}';
array_push($css_array,$header_transparent_overlay_code);
}

//header - transparent overlay - custom "overlay-rays.png" settings
if('overlay-rays.png' == $header_transparent_overlay) {
$header_transparent_overlay_code_rays = '
.header-overlay {
	background-size: auto 100%;
}';
array_push($css_array,$header_transparent_overlay_code_rays);
}

//header - height adjust
if(!empty($header_height_adjust)) {
$header_height_adjust_code = '
#header .header-area {
	padding: '.$header_height_adjust.' 0;
}';
array_push($css_array,$header_height_adjust_code);
}

//footer - transparent overlay - custom upload
if('' != $footer_transparent_overlay_upload) {
$footer_transparent_overlay_upload_code = '
.footer-overlay {
	background: url('.$footer_transparent_overlay_upload.') 50% 50% no-repeat;
}';
array_push($css_array,$footer_transparent_overlay_upload_code);
}

//footer - transparent overlay
if ('overlay-none' != $footer_transparent_overlay) {
$footer_transparent_overlay_code = '
.footer-overlay {
	background: url('.get_template_directory_uri().'/images/_global/'.$footer_transparent_overlay.') 50% 50% no-repeat;
}';
array_push($css_array,$footer_transparent_overlay_code);
}

//footer - transparent overlay - custom "overlay-rays.png" settings
if ('overlay-rays.png' == $footer_transparent_overlay) {
$footer_transparent_overlay_code_rays = '
.footer-overlay {
	background-size: auto 100%;
}';
array_push($css_array,$footer_transparent_overlay_code_rays);
}

//footer - footer callout - custom linkhover bg
if ('' != $footer_callout_linkhover) {
$footer_callout_linkhover_code = '
#footer #footer-callout-content a.footer-callout-link:hover {
	background:'.$footer_callout_linkhover.'
}';
array_push($css_array,$footer_callout_linkhover_code);
}

//footer - footer callout main bg color
if ('' != $footer_callout_main_bg) {
$footer_callout_main_bg_code = '
#footer-callout {
	background:'.$footer_callout_main_bg.'
}';
array_push($css_array,$footer_callout_main_bg_code);
}

//-----
//-----boxed layout settings
//-----

//boxed layout - drop shadow
if('true' == $boxedlayout  ){
$custom_boxedlayout_shadow_code = '
#tt-boxed-layout {
-moz-box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');
-webkit-box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');
box-shadow: 0 0 20px 0 rgba(0, 0, 0, '.$boxedlayout_shadow.');
}';
truethemes_push_custom_css($boxedlayout_shadow,$custom_boxedlayout_shadow_code);
}

//boxed layout - body bg color
if('' != $body_bg_color ){
$custom_body_bg_code = 'body{background-color:'.$body_bg_color.' !important;}';
truethemes_push_custom_css($body_bg_color,$custom_body_bg_code);
}

//boxed layout - body bg image
if($body_bg_image_select!='null'){	
$custom_body_image_select_code = 'body{background-image:url('.get_template_directory_uri().'/images/body-backgrounds/'.$body_bg_image_select.'.png) !important;background-position:'.$body_designer_page_background_position.' !important;background-repeat:'.$body_designer_page_background_repeat.' !important;}';
truethemes_push_custom_css($body_bg_image_select,$custom_body_image_select_code);
}

//boxed layout - body bg image - custom upload	
$custom_body_image_code = 'body{background-image:url('.$body_bg_image.') !important;background-repeat:repeat !important;background-position:'.$body_designer_page_background_position.' !important;background-repeat:'.$body_designer_page_background_repeat.' !important;}';
truethemes_push_custom_css($body_bg_image,$custom_body_image_code);

//boxed layout - body bg image - fixed position
if('true' == $body_designer_page_background_fixed){	
$custom_body_designer_page_background_fixed_code = 'body{background-attachment:fixed;}';
truethemes_push_custom_css($body_designer_page_background_fixed,$custom_body_designer_page_background_fixed_code);
}

//jquery3 - transparent overlay
$jquery3_transparent_overlay_code = '
#tt-slider-full-width {
	background-image: url('.get_template_directory_uri().'/images/_global/'.$jquery3_transparent_overlay.');
	background-position: 50% 50%;
	background-repeat: no-repeat;
}';
array_push($css_array,$jquery3_transparent_overlay_code);


/*--------------------------------------------------------------------*/
/* Typography */
/*--------------------------------------------------------------------*/
//font-kit-modern
if('true' == $font_kit_modern){
$font_kit_modern_code = '
body, .testimonials blockquote, .testimonials_static blockquote {font-family: \'Open Sans\', Arial, sans-serif;}
h1, h2, h3, h4, h5, #footer h3, #menu-main-nav li strong, p.footer-callout-heading, #tt-mobile-menu-button span , .post_date .day {font-family: \'Lato\', Arial, sans-serif;}
h1, h2, h3, h4, h5, h6 {margin-bottom:12px;}
p {line-height: 2;margin-bottom:20px;font-size: 13px;}
#content ol li,
#content ul li,
.content_full_width ol li,
.content_full_width ul li {font-size: 13px;}
#content p.callout2 span {font-size: 15px;}
.callout2,
.callout-wrap span {line-height:2;}
.slider-content-main p {font-size:1em;line-height:2;margin-bottom: 14px;}
.jquery3-slider-wrap .slider-content-main p {font-size:1.1em;line-height:1.8em;}
.callout-wrap span, .portfolio_content h3 {font-size: 1.4em;}
.testimonials blockquote, .testimonials_static blockquote, p.team-member-title {font-size: 13px;font-style: normal;}
.ka_button, .ka_button:hover {letter-spacing: 0.6px;}
#footer h3, #menu-main-nav li strong {letter-spacing: 0.7px;font-size:12.4px;}
#footer h3 {font-weight: 300;}
#footer p.footer-callout-heading {font-size: 18px;}
#footer .blogroll a,
#footer ul.tt-recent-posts h4 {
	font-weight: normal;
	color:rgba(255,255,255,0.8);
}
#footer ul.tt-recent-posts h4,
#sidebar ul.tt-recent-posts h4 {
	font-size: 13px !important;	
}
.tools .breadcrumb .current_crumb:after, .woocommerce-page .tt-woocommerce .breadcrumb span:last-child:after {bottom: -16px;}
.post_title span {font-weight: normal;}
.post_date .day {font-size:28px;font-weight:normal;}
.post_date .month {font-size: 15px;margin-top:-15px;}
.tools .search-form {margin-top: 1px;}
.accordion .opener strong {font-weight: normal;}
.tools .breadcrumb a:after {top:0;}
p.comment-author-about {font-weight: bold;}
';
array_push($css_array,$font_kit_modern_code);	
}



//font-kit-serif
if('true' == $font_kit_serif){
$font_kit_serif_code = '
html {font-size: 70%;}
p {line-height: 24px;margin-bottom:21px;}
p,ul,ol,.callout-wrap span, div.comment-text, label, .ka_button, .ka_button:hover, #tt-mobile-menu-button span {font-family: \'Source Sans Pro\', Arial, sans-serif;}
h1, h2, h3, h4, h5, h6, #footer h3, #menu-main-nav li strong, p.footer-callout-heading, #footer ul.tt-recent-posts h4 {font-family: \'PT Serif\', Georgia, serif;}
h1 {margin-bottom:29px;}
h3, h4 {margin-bottom:25px;}
.testimonials blockquote, .testimonials_static blockquote, p.team-member-title {font-size: 13px;font-style: normal;}
.callout-wrap span {font-size: 1.3em;}
#content p.callout2 span {font-size: 16px;}
.slider-content-main p {font-size: 1em;}
.slider-content-main h2 {font-size: 1.8em;}
#footer h3, #menu-main-nav li strong {font-weight: normal;}
#footer p.footer-callout-heading {font-size: 16px;}
#main .tools h1 {font-size: 18px;} 
.tools .breadcrumb .current_crumb:after, .woocommerce-page .tt-woocommerce .breadcrumb span:last-child:after {bottom: -9px;}
.post_title span {font-weight: normal;}
.tools .search-form {margin-top: 1px;}
';
array_push($css_array,$font_kit_serif_code);	
}


//font-kit-organic
if('true' == $font_kit_organic){
$font_kit_organic_code = '
p,ul,ol,.callout-wrap span, div.comment-text, label, .post_date .month, .post_comments, #footer ul.tt-recent-posts h4 {font-family: \'Open Sans\', Arial, sans-serif;}
h1, h2, h3, h4, h5, h6 #footer h3, #menu-main-nav li strong, p.footer-callout-heading, .ka_button, .ka_button:hover, #tt-mobile-menu-button span, .post_date .day {font-family: \'Varela Round\', Arial, sans-serif;}
p {line-height:23px;}
.callout-wrap span {font-size: 1.4em;}
#content p.callout2 span {font-size: 16px;}
.testimonials blockquote, .testimonials_static blockquote, p.team-member-title {font-size: 13px;font-style: normal;}
.ka_button, .ka_button:hover {letter-spacing: 0px;}
#footer h3, #menu-main-nav li strong {font-weight: normal;letter-spacing: 0.7px;font-size:12.4px;}
#footer h3 {font-size: 14px;text-transform:none;}
#footer p.footer-callout-heading {font-size: 16px;}
#footer .blogroll a,
#footer ul.tt-recent-posts h4 {font-weight: normal;}
.tools .breadcrumb .current_crumb:after, .woocommerce-page .tt-woocommerce .breadcrumb span:last-child:after {bottom: -8px;}
.post_title span {font-weight: normal;}
.post_date .day {font-size:28px;font-weight:normal;}
.post_date .month {font-size: 15px;margin-top:-15px;}
.tools .search-form {margin-top: 1px;}
';
array_push($css_array,$font_kit_organic_code);	
}

//grab custom font settings
//color
$custom_logo_font_color      = $ttso->ka_custom_logo_font_color;
$main_navigation_color       = $ttso->ka_main_menu_font_color;
$side_navigation_color       = $ttso->ka_side_menu_font_color;
$h1_color                    = $ttso->ka_h1_font_color;
$h2_color                    = $ttso->ka_h2_font_color;
$h3_color                    = $ttso->ka_h3_font_color;
$h4_color                    = $ttso->ka_h4_font_color;
$h5_color                    = $ttso->ka_h5_font_color;
$h6_color                    = $ttso->ka_h6_font_color;
$main_content_font_color     = $ttso->ka_main_content_font_color;
$footer_content_font_color   = $ttso->ka_footer_content_font_color;
$link_font_color             = $ttso->ka_link_font_color;
$link_hover_font_color       = $ttso->ka_link_hover_font_color;
//size
$custom_logo_font_size       = $ttso->ka_custom_logo_font_size;
$main_content_font_size      = $ttso->ka_main_content_font_size;
$main_menu_font_size         = $ttso->ka_main_menu_font_size;
$side_menu_font_size         = $ttso->ka_side_menu_font_size;
$h1_font_size                = $ttso->ka_h1_font_size;
$h2_font_size                = $ttso->ka_h2_font_size;
$h3_font_size                = $ttso->ka_h3_font_size;
$h4_font_size                = $ttso->ka_h4_font_size;
$h5_font_size                = $ttso->ka_h5_font_size;
$h6_font_size                = $ttso->ka_h6_font_size;
$footer_content_font_size    = $ttso->ka_footer_content_font_size;
//font-family
$custom_logo_font            = $ttso->ka_custom_logo_font;
$main_content_font           = $ttso->ka_main_content_font;
$main_navigation_font        = $ttso->ka_main_navigation_font;
$side_navigation_font        = $ttso->ka_sidebar_menu_font;
$h1_font                     = $ttso->ka_h1_font;
$h2_font                     = $ttso->ka_h2_font;
$h3_font                     = $ttso->ka_h3_font;
$h4_font                     = $ttso->ka_h4_font;
$h5_font                     = $ttso->ka_h5_font;
$h6_font                     = $ttso->ka_h6_font;
$footer_content_font         = $ttso->ka_footer_content_font;

//custom logo font color
$custom_logo_font_color_code = '.logo-text{color:'.$custom_logo_font_color.'!important;}';
truethemes_push_custom_css($custom_logo_font_color,$custom_logo_font_color_code);

//main_navigation_color
$main_navigation_color_code = '#menu-main-nav li strong, #menu-main-nav .navi-description, #menu-main-nav .sub-menu li a span,#menu-main-nav .sub-menu .sub-menu li a span, #menu-main-nav a:hover span, #menu-main-nav li.current_page_item a span, #menu-main-nav li.current_page_parent a span, #menu-main-nav li.current-page-ancestor a span, #menu-main-nav .drop ul li.current-menu-item a, #menu-main-nav .drop ul li.current-menu-item a span, #menu-main-nav .drop ul .drop ul li.current-menu-item a, #menu-main-nav .drop ul .drop ul li.current-menu-item a span{color:'.$main_navigation_color.'!important;}';	
truethemes_push_custom_css($main_navigation_color,$main_navigation_color_code);

//side_navigation_color
$side_navigation_color_code = '#sub_nav .sub-menu li a span{color:'.$side_navigation_color.'!important;}';	
truethemes_push_custom_css($side_navigation_color,$side_navigation_color_code);	

//Headers color
$h1_color_code = 'h1{color:'.$h1_color.'!important;}';	
truethemes_push_custom_css($h1_color,$h1_color_code);

$h2_color_code = 'h2{color:'.$h2_color.'!important;}';	
truethemes_push_custom_css($h2_color,$h2_color_code);

$h3_color_code = 'h3{color:'.$h3_color.'!important;}';	
truethemes_push_custom_css($h3_color,$h3_color_code);

$h4_color_code = 'h4{color:'.$h4_color.'!important;}';	
truethemes_push_custom_css($h4_color,$h4_color_code);	

$h5_color_code = 'h5{color:'.$h5_color.'!important;}';	
truethemes_push_custom_css($h5_color,$h5_color_code);

$h6_color_code = 'h6{color:'.$h6_color.'!important;}';	
truethemes_push_custom_css($h6_color,$h6_color_code);

//main_content_font_color
$main_content_font_code = '#content p, .content_full_width p, .slider-content-main p, .contact-form label{color:'.$main_content_font_color.'!important;}
#content .colored_box p, .content_full_width .colored_box p {color: #FFF !important;}';	
truethemes_push_custom_css($main_content_font_color,$main_content_font_code);	

//footer_content_font_color
$footer_content_font_code = '#footer, #footer ul li a, #footer ul li, #footer h3{color:'.$footer_content_font_color.'!important;}';	
truethemes_push_custom_css($footer_content_font_color,$footer_content_font_code);	

//link_font_color
$link_font_code = 'a{color:'.$link_font_color.'!important;}';	
truethemes_push_custom_css($link_font_color,$link_font_code);

//link_hover_font_color
$link_hover_font_code = 'a:hover{color:'.$link_hover_font_color.'!important;}';	
truethemes_push_custom_css($link_hover_font_color,$link_hover_font_code);

//custom logo font size
$custom_logo_font_code = '.logo-text{font-size:'.$custom_logo_font_size.'!important;}';
truethemes_push_custom_css($custom_logo_font_size,$custom_logo_font_code);

//main content font size
$main_content_font_size_code = '#main{font-size:'.$main_content_font_size.'!important;}';
truethemes_push_custom_css($main_content_font_size,$main_content_font_size_code);	

//main navigation font size
$main_menu_font_size_code = '#menu-main-nav, #menu-main-nav li a span strong{font-size:'.$main_menu_font_size.'!important;}';
truethemes_push_custom_css($main_menu_font_size,$main_menu_font_size_code);

//side navigation font size
$side_menu_font_size_code = '#sub_nav{font-size:'.$side_menu_font_size.'!important;}';
truethemes_push_custom_css($side_menu_font_size,$side_menu_font_size_code);

//Header's font size
$h1_font_size_code = 'h1{font-size:'.$h1_font_size.'!important;}';
truethemes_push_custom_css($h1_font_size,$h1_font_size_code);

$h2_font_size_code = 'h2{font-size:'.$h2_font_size.'!important;}';
truethemes_push_custom_css($h2_font_size,$h2_font_size_code);

$h3_font_size_code = 'h3{font-size:'.$h3_font_size.'!important;}';
truethemes_push_custom_css($h3_font_size,$h3_font_size_code);

$h4_font_size_code = 'h4{font-size:'.$h4_font_size.'!important;}';
truethemes_push_custom_css($h4_font_size,$h4_font_size_code);

$h5_font_size_code = 'h5{font-size:'.$h5_font_size.'!important;}';
truethemes_push_custom_css($h5_font_size,$h5_font_size_code);	

$h6_font_size_code = 'h6{font-size:'.$h6_font_size.'!important;}';
truethemes_push_custom_css($h6_font_size,$h6_font_size_code);

$footer_content_font_size_code = '#footer{font-size:'.$footer_content_font_size.'!important;}';
truethemes_push_custom_css($footer_content_font_size,$footer_content_font_size_code);

//custom logo font type
$custom_logo_font_code = '.logo-text {font-family:\''.$custom_logo_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($custom_logo_font,$custom_logo_font_code);	

//main_content_font
$main_content_font_code = '#main{font-family:\''.$main_content_font.'\', Arial, sans-serif;}'."\n";		
truethemes_push_custom_font($main_content_font,$main_content_font_code);	

//main navigation font type
$main_navigation_font_code = '#menu-main-nav{font-family:\''.$main_navigation_font.'\', Arial, sans-serif;}'."\n";		
truethemes_push_custom_font($main_navigation_font,$main_navigation_font_code);

//side navigation font type
$side_navigation_font_code = '#sub_nav{font-family:\''.$side_navigation_font.'\', Arial, sans-serif;}'."\n";		
truethemes_push_custom_font($side_navigation_font,$side_navigation_font_code);

//Header's font type
$h1_font_code = 'h1{font-family:\''.$h1_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h1_font,$h1_font_code);		

$h2_font_code = 'h2{font-family:\''.$h2_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h2_font,$h2_font_code);		

$h3_font_code = 'h3{font-family:\''.$h3_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h3_font,$h3_font_code);	

$h4_font_code = 'h4{font-family:\''.$h4_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h4_font,$h4_font_code);		

$h5_font_code = 'h5{font-family:\''.$h5_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h5_font,$h5_font_code);		

$h6_font_code = 'h6{font-family:\''.$h6_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($h6_font,$h6_font_code);		

$footer_content_font_code = '#footer{font-family:\''.$footer_content_font.'\', Arial, sans-serif;}'."\n";	
truethemes_push_custom_font($footer_content_font,$footer_content_font_code);

//construct items and links to print in <head>			

//if not empty css_link_container
    if(!empty($css_link_container)){
       foreach($css_link_container as $css_link){
        echo $css_link."\n";
       }
    }		
	
//if not empty $css_array, print it out in <head>	
	if(!empty($css_array)){
	  echo "<!--styles generated by site options-->\n";
	  echo"<style type='text/css'>\n";
	        foreach($css_array as $css_item){
	         echo $css_item."\n";	        
	        }
	  echo"</style>\n";
	}

}
add_action('wp_head','truethemes_settings_css',90);


/*------------------------------------------------*/
/*	 Custom Login Logo
/*------------------------------------------------*/
function truethemes_custom_login_logo(){
        global $ttso;
		$loginlogo = $ttso->ka_loginlogo;
        echo '<style>
            .login h1 a { background-image:url('.$loginlogo.') !important;background-size:inherit !important; }
        </style>';
}
add_action('login_head', 'truethemes_custom_login_logo');
    
    

/*------------------------------------------------*/
/*	 Custom Login Logo URL
/*------------------------------------------------*/
function truethemes_change_wp_login_url() {
   //since version 3.0
   $wordpress_version = get_bloginfo('version');
   if($wordpress_version > '3.3.4'){
    return site_url();
   }   
}
add_filter('login_headerurl', 'truethemes_change_wp_login_url');
    
function truethemes_change_wp_login_title() {

   //updated version 2.7.0
   $wordpress_version = get_bloginfo('version');
   if($wordpress_version >= '3.3.4'){
    return get_option('blogname');
   }else{
    echo get_option('blogname');
   }
}
add_filter('login_headertitle', 'truethemes_change_wp_login_title');


/*
* function to push in custom css font color and font-size etc..
* for use in truethemes_settings_css()
* @since version 2.6 development
* @param string $option_value, assigned option value from database
* @param string $css_code, for custom css code.
*/
function truethemes_push_custom_css($option_value,$css_code){

global $css_array;

	if($option_value!=''&&$option_value!='--select--'){	
	 $option_value_code = $css_code;
	 array_push($css_array,$option_value_code);	
	}


}

/*------------------------------------------------*/
/* Add Favicon
/*------------------------------------------------*/
function karma_favicon() {
	$GLOBALS['favicon'] = get_option('ka_favicon');
	          if($GLOBALS['favicon'] != '')
	        echo '<link rel="shortcut icon" href="'.  $GLOBALS['favicon'] .'"/>'."\n";
	    }

add_action('wp_head', 'karma_favicon');


/*------------------------------------------------*/
/* Add analytics code to footer */
/*------------------------------------------------*/
function karma_analytics(){
	
	$GLOBALS['google']          = get_option('ka_google_analytics');
	$GLOBALS['customcode_body'] = get_option('ka_customcode_body');
			
			if($GLOBALS['google'] != '')          echo stripslashes($GLOBALS['google']) . "\n";
			if($GLOBALS['customcode_body'] != '') echo stripslashes($GLOBALS['customcode_body']) . "\n";
			
			}
add_action('wp_footer','karma_analytics');


/*------------------------------------------------*/
/* Hide Meta Boxes (if_enabled) */
/*------------------------------------------------*/
function karma_metaboxes(){
	$GLOBALS['hide_metaboxes'] = get_option('ka_hidemetabox');
	          if($GLOBALS['hide_metaboxes'] == "true"){				  
				  
/* pages */
remove_meta_box('commentstatusdiv','page','normal'); // Comments
remove_meta_box('commentsdiv','page','normal');      // Comments
remove_meta_box('trackbacksdiv','page','normal');    // Trackbacks
remove_meta_box('postcustom','page','normal');       // Custom Fields
remove_meta_box('authordiv','page','normal');        // Author

/* posts */
remove_meta_box('commentsdiv','post','normal'); // Comments
remove_meta_box('postcustom','post','normal');  // Custom Fields
		
}
}
add_action('admin_menu','karma_metaboxes',90);

//CSS to hide metaboxes
function karma_css_hide_slug_metabox(){
	$GLOBALS['hide_metaboxes'] = get_option('ka_hidemetabox');
	          if($GLOBALS['hide_metaboxes'] == "true"){
	echo"<style>#slugdiv, #slugdiv-hide, label[for='slugdiv-hide']{display:none!important;}</style>";
	}          
}
add_action('admin_head','karma_css_hide_slug_metabox');


/*
* function to auto update WordPress (allow people to post comments on new articles) setting, under WordPress admin settings/discussion.
* 
* checks for user setting in site option.
* @since version 2.6 development
*
*/
function truethemes_disable_comments(){
if(is_admin()):
global $ttso;
$show_posts_comments = '';
$show_posts_comments = $ttso->ka_post_comments;

	if($show_posts_comments !='false'){
	update_option('default_comment_status','open');
	}else{
	update_option('default_comment_status','closed');
	}
endif;	
}
add_action('init','truethemes_disable_comments');
?>