<?php
/*-----------------------------------------------------------------------------------*/
/* Any WooCommerce overrides and functions can be found here
/*-----------------------------------------------------------------------------------*/

// Set Number of Products to display on shop page
add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'));


// Remove WooCommerce Sidebar - Custom Sidebar added to Theme
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


// Remove WooCommerce Breadrcumbs
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);


// Remove WooCommerce default CSS
define('WOOCOMMERCE_USE_CSS', false);


// Add WooCommerce Breadrcumbs to custom function
add_action( 'tt_woo_breadcrumbs', 'woocommerce_breadcrumb', 20, 0);


// Adjust WooCommerce Content Wrapper
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'woostore_before_content', 10);
add_action('woocommerce_after_main_content', 'woostore_after_content', 20);



function woostore_before_content() {
// Grab WooCommerce values from Site Options Panel
global $ttso;
$woocommerce_layout       = $ttso->ka_woocommerce_layout;
$woocommerce_tools_panel  = $ttso->ka_woocommerce_tools_panel;

//pre-define options for backward-compatible
if ('' == $woocommerce_layout): 'Right Sidebar' == $woocommerce_layout; endif;
if ('' == $woocommerce_tools_panel): 'true'     == $woocommerce_tools_panel; endif;


echo '</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<div id="main" class="tt-woocommerce">
	<div class="main-area">';

if ('true' == $woocommerce_tools_panel) {
get_template_part('theme-template-part-tools-woocommerce','childtheme');
}

//if Right Sidebar
if ('Right Sidebar' == $woocommerce_layout): echo '<main role="main" id="content">'; endif;


//if Left Sidebar
if ('Left Sidebar' == $woocommerce_layout): echo '<main role="main" id="content" class="content_left_sidebar">'; endif;


//if Full-Width
if ('Full Width' == $woocommerce_layout): echo '<main role="main" id="content" class="content_full_width">'; endif;
}

 
function woostore_after_content() {
// Grab WooCommerce values from Site Options Panel
global $ttso;
$woocommerce_layout       = $ttso->ka_woocommerce_layout;
$woocommerce_tools_panel  = $ttso->ka_woocommerce_tools_panel;

//pre-define options for backward-compatible
if ('' == $woocommerce_layout): 'Right Sidebar' == $woocommerce_layout; endif;


echo '</main><!-- END main #content -->';

//if Right Sidebar
if ('Right Sidebar' == $woocommerce_layout): 

echo '<aside role="complementary" id="sidebar" class="right_sidebar">';
dynamic_sidebar("WooCommerce Sidebar");
echo'</aside><!-- END .right_sidebar-->';

endif;


//if Left Sidebar
if ('Left Sidebar' == $woocommerce_layout): 

echo '<aside role="complementary" id="sidebar" class="left_sidebar">';
dynamic_sidebar("WooCommerce Sidebar");
echo'</aside><!-- END .left_sidebar-->';

endif;




echo '</div><!-- END main-area -->
</div> <!-- END main -->';
}


function tt_woo_breadcrumbs() {
/**
 * Shop Breadcrumb
 */

global $post, $wp_query;


// Grab custom "Home" title from TrueThemes Site Options Panel
global $ttso;
$home_text = $ttso->ka_breadcrumbs_home_text;

if( !$home ) $home = _x($home_text, 'breadcrumb', 'truethemes_localize');

$home_link = home_url();

$prepend   = '';
$delimiter = '';
$before    = '<span>';
$after     = '</span>';

if ( get_option('woocommerce_prepend_shop_page_to_urls')=="yes" && woocommerce_get_page_id('shop') && get_option('page_on_front') !== woocommerce_get_page_id('shop') )
	$prepend =  $before . '<a href="' . get_permalink( woocommerce_get_page_id('shop') ) . '">' . get_the_title( woocommerce_get_page_id('shop') ) . '</a> ' . $after . $delimiter;

if ( (!is_home() && !is_front_page() && !(is_post_type_archive() && get_option('page_on_front')==woocommerce_get_page_id('shop'))) || is_paged() ) :

	echo $wrap_before;
	
	echo $before  . '<a href="' . $home_link . '">' . $home . '</a> '  . $after . $delimiter ;
	
	if ( is_category() ) :
	
		$cat_obj = $wp_query->get_queried_object();
		$this_category = $cat_obj->term_id;
		$this_category = get_category( $this_category );
		if ($this_category->parent != 0) :
			$parent_category = get_category( $this_category->parent );
			echo get_category_parents($parent_category, TRUE, $delimiter );
		endif;
		echo $before . single_cat_title('', false) . $after;
	
	elseif ( is_tax('product_cat') ) :
		
		echo $prepend;
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	
		$parents = array();
		$parent = $term->parent;
		while ($parent):
			$parents[] = $parent;
			$new_parent = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
			$parent = $new_parent->parent;
		endwhile;
		
		if(!empty($parents)):
			$parents = array_reverse($parents);
			foreach ($parents as $parent):
				$item = get_term_by( 'id', $parent, get_query_var( 'taxonomy' ));
				echo $before .  '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>' . $after . $delimiter;
			endforeach;
		endif;
	
		$queried_object = $wp_query->get_queried_object();
		echo $before . $queried_object->name . $after;
	
	elseif ( is_tax('product_tag') ) :
	
		$queried_object = $wp_query->get_queried_object();
		echo $prepend . $before . __('Products tagged &ldquo;', 'truethemes_localize') . $queried_object->name . '&rdquo;' . $after;
	
	elseif ( is_day() ) :
	
		echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
		echo $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after . $delimiter;
		echo $before . get_the_time('d') . $after;
	
	elseif ( is_month() ) :
	
		echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
		echo $before . get_the_time('F') . $after;
	
	elseif ( is_year() ) :
	
		echo $before . get_the_time('Y') . $after;
	
	elseif ( is_post_type_archive('product') && get_option('page_on_front') !== woocommerce_get_page_id('shop') ) :
	
		$_name = woocommerce_get_page_id('shop') ? get_the_title( woocommerce_get_page_id('shop') ) : ucwords(get_option('woocommerce_shop_slug'));
	
		if (is_search()) :
	
			echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $delimiter . __('Search results for &ldquo;', 'truethemes_localize') . get_search_query() . '&rdquo;' . $after;
	
		else :
	
			echo $before . '<a href="' . get_post_type_archive_link('product') . '">' . $_name . '</a>' . $after;
	
		endif;
	
	elseif ( is_single() && !is_attachment() ) :
	
	if ( get_post_type() == 'product' ) :
	
			echo $prepend;
	
			if ($terms = wp_get_object_terms( $post->ID, 'product_cat' )) :
			$term = current($terms);
			$parents = array();
			$parent = $term->parent;
			while ($parent):
				$parents[] = $parent;
				$new_parent = get_term_by( 'id', $parent, 'product_cat');
				$parent = $new_parent->parent;
			endwhile;
			if(!empty($parents)):
				$parents = array_reverse($parents);
				foreach ($parents as $parent):
					$item = get_term_by( 'id', $parent, 'product_cat');
					echo $before . '<a href="' . get_term_link( $item->slug, 'product_cat' ) . '">' . $item->name . '</a>' . $after . $delimiter;
				endforeach;
			endif;
			echo $before . '<a href="' . get_term_link( $term->slug, 'product_cat' ) . '">' . $term->name . '</a>' . $after . $delimiter;
		endif;
	
		//Modified by TrueThemes
		echo $before . '<a>' . get_the_title() . '</a>' . $after;
	
	elseif ( get_post_type() != 'post' ) :
		$post_type = get_post_type_object(get_post_type());
		$slug = $post_type->rewrite;
			echo $before . '<a href="' . get_post_type_archive_link(get_post_type()) . '">' . $post_type->labels->singular_name . '</a>' . $after . $delimiter;
		echo $before . get_the_title() . $after;
	else :
		$cat = current(get_the_category());
		echo get_category_parents($cat, TRUE, $delimiter);
		echo $before . get_the_title() . $after;
	endif;
	
	elseif ( is_404() ) :
	
		echo $before . __('Error 404', 'truethemes_localize') . $after;
	
	elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) :
	
		$post_type = get_post_type_object(get_post_type());
		if ($post_type) : echo $before . $post_type->labels->singular_name . $after; endif;
	
	elseif ( is_attachment() ) :
	
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); $cat = $cat[0];
		echo get_category_parents($cat, TRUE, '' . $delimiter);
		echo $before . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>' . $after . $delimiter;
		echo $before . get_the_title() . $after;
	
	elseif ( is_page() && !$post->post_parent ) :
	
		echo $before . get_the_title() . $after;
	
	elseif ( is_page() && $post->post_parent ) :
	
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) :
			echo $crumb . '' . $delimiter;
		endforeach;
		echo $before . get_the_title() . $after;
	
	elseif ( is_search() ) :
	
		echo $before . __('Search results for &ldquo;', 'truethemes_localize') . get_search_query() . '&rdquo;' . $after;
	
	elseif ( is_tag() ) :
	
			echo $before . __('Posts tagged &ldquo;', 'truethemes_localize') . single_tag_title('', false) . '&rdquo;' . $after;
	
	elseif ( is_author() ) :
	
		$userdata = get_userdata($author);
		echo $before . __('Author:', 'truethemes_localize') . ' ' . $userdata->display_name . $after;
	
	endif;
	
	if ( get_query_var('paged') ) :
	
		echo ' (' . __('Page', 'truethemes_localize') . ' ' . get_query_var('paged') .')';
	
	endif;
	
	echo $wrap_after;

endif;
}