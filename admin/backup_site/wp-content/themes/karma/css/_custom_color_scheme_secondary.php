<?php
// @since 4.0 - Karma Custom color scheme CSS

global $ttso;
// secondary color scheme
$custom_scheme_secondary_gradient_light            =   $ttso->ka_custom_scheme_secondary_gradient_light;
$custom_scheme_secondary_gradient_dark             =   $ttso->ka_custom_scheme_secondary_gradient_dark;
$custom_scheme_secondary_active_horz_link          =   $ttso->ka_custom_scheme_secondary_active_horz_link;
$custom_scheme_secondary_link_color                =   $ttso->ka_custom_scheme_secondary_link_color;

// secondary color scheme - ie8
$custom_scheme_secondary_ie8_footer_links          =   $ttso->ka_custom_scheme_secondary_ie8_footer_links;
$custom_scheme_secondary_ie8_footer_headings       =   $ttso->ka_custom_scheme_secondary_ie8_footer_headings;

// secondary color scheme - images
$custom_scheme_image_footer_bottom                 = $ttso->ka_custom_scheme_image_footer_bottom;
$custom_scheme_image_jquery_banner                 = $ttso->ka_custom_scheme_image_jquery_banner;
$custom_scheme_image_nav_state                     = $ttso->ka_custom_scheme_image_nav_state;
$custom_scheme_image_top                           = $ttso->ka_custom_scheme_image_top;
$custom_scheme_image_middle                        = $ttso->ka_custom_scheme_image_middle;
$custom_scheme_image_bottom                        = $ttso->ka_custom_scheme_image_bottom;


echo '
<style>
/*------------------------------------------------*/
/* Custom Secondary Color Scheme 
/*------------------------------------------------*/
/*---------------------*/
/* Sliders
/*---------------------*/
/* jQuery1 slider + utility bar */
.jquery1-slider-wrap,
.tools {
background-color: '.$custom_scheme_secondary_gradient_light.';
background: -webkit-gradient(radial, center center, 0, center center, 460, from('.$custom_scheme_secondary_gradient_light.'), to('.$custom_scheme_secondary_gradient_dark.'));
background: -webkit-radial-gradient(circle, '.$custom_scheme_secondary_gradient_light.', '.$custom_scheme_secondary_gradient_dark.');
background: -moz-radial-gradient(circle, '.$custom_scheme_secondary_gradient_light.', '.$custom_scheme_secondary_gradient_dark.');
background: -ms-radial-gradient(circle, '.$custom_scheme_secondary_gradient_light.', '.$custom_scheme_secondary_gradient_dark.');
}

/* IE Image Fallback */
.ie7 .jquery1-slider-wrap,
.ie8 .jquery1-slider-wrap,
.ie9 .jquery1-slider-wrap {
	background: transparent url('.$custom_scheme_image_jquery_banner.') 0 0 no-repeat;
}

/* overwrite box-shadow from style.css (for lighter color schemes only) */
.jquery1-slider-wrap {
	-webkit-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.3);
       -moz-box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.3);
            box-shadow: inset 0 0 7px rgba(0, 0, 0, 0.3);
}


/*---------------------*/
/* Sub Menus
/*---------------------*/
/* horizontal */
#horizontal_nav ul a:hover,
#horizontal_nav ul .current_page_item,
#horizontal_nav.tt-gallery-nav-wrap .active,
/* tabs */
.tabset .ui-state-active,
.tabset .active,
.tabset a:hover,
/* wp-page-navi */
.karma-pages span.current,
.wp-pagenavi span.current {
	background: '.$custom_scheme_secondary_active_horz_link.';
}

/* vertical */
#sub_nav ul a:hover,
#sub_nav ul li.current_page_item a,
#sub_nav.nav_right_sub_nav ul a:hover,
#sub_nav.nav_right_sub_nav ul li.current_page_item a {
	background: url('.$custom_scheme_image_nav_state.') 0px 0px no-repeat;
}

/* overwrite box-shadow from style.css (for lighter color schemes only) */
#horizontal_nav ul a:hover,
#horizontal_nav ul .current_page_item a,
/* tabs */
.tabset .ui-state-active,
.tabset .active,
.tabset a:hover,
/* wp-page-navi */
.karma-pages span.current,
.wp-pagenavi span.current {
	-webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
       -moz-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
}


/*---------------------*/
/* Links / Lists
/*---------------------*/
/* links */
a,
p a strong,
.link-top,
.tt_comment_required,
ul.tt-recent-posts h4,
span.required,
/* lists */
ul.list li,
ul.list1 li:before,
ul.list2 li:before,
ul.list3 li:before,
ul.list4 li:before,
ul.list5 li:before,
ul.list6 li:before,
ul.list7 li:before,
ul.list8 li:before,
#sidebar ul li:before,
#sub_nav ul li .sub-menu li:before,
#sub_nav ul li .sub-menu li .sub-menu li:before,
#sidebar ul li,
/* left nav */
#sub_nav ul li .sub-menu a,
#sub_nav ul li .sub-menu li.current_page_item a,
#sub_nav ul ul a,
#sub_nav ul ul a:hover,
#sub_nav ul li.current_page_item ul li a,
#sub_nav ul li.current_page_parent ul li.current_page_item a,
/* right nav */
#sub_nav.nav_right_sub_nav ul ul a,
#sub_nav.nav_right_sub_nav ul ul a:hover,
#sub_nav.nav_right_sub_nav ul li.current_page_item ul li a,
#sub_nav.nav_right_sub_nav ul li.current_page_parent ul li.current_page_item a,
#sub_nav .sub_nav_sidebar .textwidget ul li,
#sub_nav .sub_nav_sidebar a,
i.discussion-title,
#sidebar ul.social_icons.tt_vector_social_icons a:after,
#content p.team-member-title {
	color: '.$custom_scheme_secondary_link_color.';
}


/*---------------------*/
/* Layout
/*---------------------*/
.post_comments {
	box-shadow: 0 0 0 1px '.$custom_scheme_secondary_gradient_light.', 0 0 0 2px '.$custom_scheme_secondary_gradient_dark.';
	background-color: '.$custom_scheme_secondary_gradient_dark.';
	background-image: linear-gradient(to bottom, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -webkit-gradient(linear, left top, left bottom, from('.$custom_scheme_secondary_gradient_dark.'), to('.$custom_scheme_secondary_gradient_light.'));
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -moz-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -webkit-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: -o-linear-gradient(top, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	background-image: ms-linear-gradient(to bottom, '.$custom_scheme_secondary_gradient_dark.', '.$custom_scheme_secondary_gradient_light.');
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=\''.$custom_scheme_secondary_gradient_dark.'\', endColorstr=\''.$custom_scheme_secondary_gradient_light.'\');
}

/* IE8 + IE9 do not support CSS3 radial gradient - fallback images provided below */
.ie8 .tools .frame,
.ie9 .tools .frame {
	background: url('.$custom_scheme_image_middle.') repeat-y;
}

.ie8 span.tools-top,
.ie9 span.tools-top {
	background: url('.$custom_scheme_image_top.') no-repeat;
}

.ie8 span.tools-bottom,
.ie9 span.tools-bottom {
	background: url('.$custom_scheme_image_bottom.') 0 100% no-repeat;
}

/*---------------------*/
/* IE8
/*---------------------*/
.ie8 .footer-content a,
.ie8 #footer_bottom a,
.ie8 #footer .blogroll li,
.ie8 #mc_signup .mc_required,
.ie8 .mc_required,
.ie8 #mc-indicates-required {
	color: '.$custom_scheme_secondary_ie8_footer_links.';
}

.ie8 #footer h3 {
	border-bottom: 1px solid '.$custom_scheme_secondary_ie8_footer_headings.';
}
</style>
';
?>