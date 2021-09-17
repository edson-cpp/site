<?php
// @since 4.0 - Karma Custom color scheme CSS

global $ttso;
// primary color scheme
$custom_scheme_primary_toolbar                     =   $ttso->ka_custom_scheme_primary_toolbar;
$custom_scheme_primary_gradient_light              =   $ttso->ka_custom_scheme_primary_gradient_light;
$custom_scheme_primary_gradient_dark               =   $ttso->ka_custom_scheme_primary_gradient_dark;
$custom_scheme_primary_border_top                  =   $ttso->ka_custom_scheme_primary_border_top;
$custom_scheme_primary_footer_text                 =   $ttso->ka_custom_scheme_primary_footer_text;
$custom_scheme_primary_footer_bottom               =   $ttso->ka_custom_scheme_primary_footer_bottom;
$custom_scheme_primary_menu_dropdown_bg            =   $ttso->ka_custom_scheme_primary_menu_dropdown_bg;
$custom_scheme_primary_menu_dropdown_linkhover_bg  =   $ttso->ka_custom_scheme_primary_menu_dropdown_linkhover_bg;

// primary color scheme - ie8
$custom_scheme_primary_ie8_toolbar_text            =   $ttso->ka_custom_scheme_primary_ie8_toolbar_text;
$custom_scheme_primary_ie8_navi_text               =   $ttso->ka_custom_scheme_primary_ie8_toolbar;

// primary color scheme - images
$custom_scheme_image_footer_bottom                 = $ttso->ka_custom_scheme_image_footer_bottom;

echo '
<style>
/*------------------------------------------------*/
/* Custom Primary Color Scheme 
/*------------------------------------------------*/
/*---------------------*/
/* Header 
/*---------------------*/
.top-block,
.top-block ul.sf-menu li ul,
#footer-callout,
#tt-slider-full-width {
	background: '.$custom_scheme_primary_toolbar.';
}

/* primary color scheme (header / footer background) */
.header-holder,
#footer {
	border-top: 1px solid '.$custom_scheme_primary_border_top.';
	background-color: '.$custom_scheme_primary_gradient_dark.';
	background-image: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -webkit-gradient(linear, left top, left bottom, from('.$custom_scheme_primary_gradient_light.'), to('.$custom_scheme_primary_gradient_dark.'));
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -moz-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: -o-linear-gradient(top, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	background-image: ms-linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
	-pie-background: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.');
}

/* Custom CSS3 Color Stops for different height headers */
.header-holder.tt-logo-center {
	background-image: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.' 80%);
	-pie-background: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.' 80%);	
}

.header-holder.tt-header-holder-tall {
	background-image: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.' 47%);
	-pie-background: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.' 47%);	
}

#footer {
	background-image: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.' 64%);
	-pie-background: linear-gradient(to bottom, '.$custom_scheme_primary_gradient_light.', '.$custom_scheme_primary_gradient_dark.' 64%);	
}

.top-block,
.top-block a,
#header .toolbar-left li,
#header .toolbar-right li {
	color: rgba(255,255,255, 0.6);
}

#tt-mobile-menu-button span:after,
.tt-icon-box span.fa-stack {
	color: '.$custom_scheme_primary_gradient_light.';	
}

/*---------------------*/
/* Main Menu
/*---------------------*/
#menu-main-nav a span.navi-description,
/* reset search/404 navi-description so "blog" isn\'t active */
.search-header #menu-main-nav li.current_page_parent a span.navi-description,
.error-header #menu-main-nav li.current_page_parent a span.navi-description,
.top-block .top-holder ul.sf-menu li .sub-menu li a:hover {
	color: rgba(255,255,255, 0.4);
}

/* dropdown active link color */
#menu-main-nav .drop ul li.current-menu-item a,
#menu-main-nav .drop ul li.current-menu-ancestor a,
#menu-main-nav .drop ul li.current-menu-parent ul li.current-menu-item a,
#menu-main-nav .drop ul li.current-menu-ancestor ul li.current-menu-ancestor a,
#menu-main-nav .drop ul li.current-menu-ancestor ul li.current-menu-ancestor ul li.current-menu-item a {
	color: '.$custom_scheme_primary_menu_dropdown_linkhover_bg.';
}

/* dropdown menu bg color */
#menu-main-nav .drop .c,
#menu-main-nav li.parent:hover,
.tt-logo-center #menu-main-nav li.parent:first-child:hover,
#wrapper.tt-uberstyling-enabled #megaMenu ul.megaMenu > li.menu-item.tt-uber-parent:hover,
#wrapper.tt-uberstyling-enabled #megaMenu ul.megaMenu li.menu-item ul.sub-menu {
	background: '.$custom_scheme_primary_menu_dropdown_bg.';
}

/* dropdown link:hover bg color */
#menu-main-nav .drop ul a:hover,
#menu-main-nav .drop ul li.current-menu-item.hover a,
#menu-main-nav .drop ul li.parent.hover a,
#menu-main-nav .drop ul li.parent.hover a:hover,
#menu-main-nav .drop ul li.hover ul li.hover a,
#menu-main-nav .drop ul li.hover ul li.hover a:hover,
#menu-main-nav .drop ul li.current-menu-ancestor.hover a,
#menu-main-nav .drop ul li.current-menu-ancestor.hover ul a:hover,
#menu-main-nav .drop ul li.current-menu-ancestor ul li.current-menu-ancestor ul li.current-menu-item a:hover,
.top-block .top-holder ul.sf-menu li .sub-menu li a:hover,
#wrapper.tt-uberstyling-enabled .header-area #megaMenu ul li.menu-item.ss-nav-menu-mega ul.sub-menu li.menu-item > a:hover {
	background: '.$custom_scheme_primary_menu_dropdown_linkhover_bg.';
	color:#FFF;
}

/* reset dropdown link:hover on non-active items */
#menu-main-nav .drop ul li.parent.hover ul a,
#menu-main-nav .drop ul li.hover ul li.hover ul li a,
#menu-main-nav .drop ul li.current-menu-ancestor.hover ul a {
	background:none;	
}


/*---------------------*/
/* Footer
/*---------------------*/
#footer_bottom {
	background: '.$custom_scheme_primary_footer_bottom.' url('.$custom_scheme_image_footer_bottom.') top center repeat-x;
}

.footer-content a,
#footer_bottom a,
#footer .blogroll li,
#mc_signup .mc_required,
.mc_required,
#mc-indicates-required,
#footer ul.tt-recent-posts li p {
	color: rgba(255,255,255, 0.35);
}

#footer .blogroll a,
#footer ul.tt-recent-posts h4 {
	color: #FFF;
}

#footer h3 {
	border-bottom: 1px solid rgba(255,255,255, 0.2);
}

#footer,
#footer p,
#footer ul,
#footer_bottom,
#footer_bottom p,
#footer_bottom ul,
#footer #mc_signup_form label {
	color: '.$custom_scheme_primary_footer_text.';
}

/*---------------------*/
/* IE8
/*---------------------*/
/* IE8 does not support rgba. hex# colors provided below */
.ie8 .top-block,
.ie8 .top-block a,
.ie8 #header .toolbar-left li,
.ie8 #header .toolbar-right li {
	color: '.$custom_scheme_primary_ie8_toolbar_text.';
}

.ie8 #menu-main-nav a span.navi-description,
/* reset search/404 navi-description so "blog" isn\'t active */
.ie8 .search-header #menu-main-nav li.current_page_parent a span.navi-description,
.ie8 .error-header #menu-main-nav li.current_page_parent a span.navi-description,
.top-block .top-holder ul.sf-menu li .sub-menu li a:hover {
	color: '.$custom_scheme_primary_ie8_navi_text.';
}
</style>
';
?>