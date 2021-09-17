<?php
/*
Template Name: Portfolio :: 1 Column - Portrait
*/
?>
<?php
get_header();

//grab custom page settings
$karma_slider_type              = get_post_meta($post->ID, 'karma_slider_type', true);
$cu3er_page_slider              = get_post_meta($post->ID, 'slider_3d_cu3er_id', true);
$slider_custom_shortcode        = get_post_meta($post->ID, 'slider_custom_shortcode', true);
$custom_menu_slug               = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
$slider_disable_toolbar         = get_post_meta($post->ID, 'slider_disable_toolbar',true);
$tt_karma_slider_category       = get_post_meta($post->ID, 'tt_karma_slider_category',true);
$sub_menu_toggle                = get_post_meta($post->ID, 'truethemes_page_checkbox',true);

//define new options for backward compatible
if ('' == $slider_custom_shortcode):  'null'    == $slider_custom_shortcode; endif;
if ('' == $slider_disable_toolbar):   'false'   == $slider_disable_toolbar; endif;

//define custom slider class for div#main
if ('' != $karma_slider_type) $karma_slider_class       = $karma_slider_type;
if ('' != $cu3er_page_slider) $karma_slider_class       = 'karma-3d-slider';
if ('' != $slider_custom_shortcode) $karma_slider_class = 'karma-custom-shortcode-slider';

//jquery2 slider
if ('karma-custom-jquery-2' == $karma_slider_type): get_template_part('theme-template-part-slider-jquery-2','childtheme'); endif;

//3D slider
if (is_numeric($cu3er_page_slider)): ?>
		<div class="cu3er-slider-wrap">
			<?php
            $slider_output = '[CU3ER slider=\''.$cu3er_page_slider.'\']';
            echo '<div id="CU3ER'.$cu3er_page_slider.'" class="embedCU3ER">'.do_shortcode($slider_output).'</div><!-- END CU3ER -->';
            ?>
        </div><!-- END cu3er-slider-wrap -->
<?php endif;?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main" class="tt-slider-<?php echo $karma_slider_class;?>">
	<div class="main-area">
	<?php get_template_part('theme-template-part-tools','childtheme');
	
//horizontal sub-menu
if ('on' != $sub_menu_toggle): ?>
<div id="horizontal_nav">
		<?php
			//default sub-menu
			if(empty($custom_menu_slug)):
				 wp_nav_menu(array(
					'container'      => false,
					'depth'          => 0,
					'theme_location' => 'Primary Navigation',	
					'walker'         => new sub_nav_walker() 
				));
			else:
				//custom sub-menu set by user
				 echo '<ul class="sub-menu">';
				 wp_nav_menu(array(
					"container" => false,
					'depth' => 0,
					"menu" => "$custom_menu_slug",
					'walker' => "" 
				));
				 echo '</ul>'; 
			endif;
		 ?>
</div><!-- END horizontal_nav -->
<?php endif; //end horizontal_nav ?>

    
<main role="main" id="content" class="portfolio_full_width">
<?php 
//display page content
if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif;

//settings for old, non-filterable Gallery
remove_filter('pre_get_posts','wploop_exclude');
$portfolio_count   = get_post_meta($post->ID, "_sc_port_count_value", $single = true);
$category_id       = get_post_meta($post->ID, '_multiple_portfolio_cat_id', true);
$posts_p_p         = stripslashes($portfolio_count);
$paged             = (get_query_var('paged')) ? get_query_var('paged') : 1;
$query_string      ="posts_per_page=$posts_p_p&cat=$category_id&paged=$paged&order=ASC";
query_posts($query_string);
$count = 0;
$col   = 0;

if (have_posts()) : while (have_posts()) : the_post();

//@since 4.0
//Check non-filterable gallery page metabox...if Value is not present we display the new Filterable Gallery
if('-1' == $category_id) {
	
	
	



} else { //we display non-filterable gallery...

$count++; $col ++; $mod = ($count % 1 == 0) ? 0 : 1 - $count % 1;

//retrieve all post meta of posts in the loop.
$linkpost            = get_post_meta($post->ID, "_jcycle_url_value", $single = true);
$portfolio_full      = get_post_meta($post->ID, "_portimage_full_value", $single = true);
$phototitle          = get_post_meta($post->ID, "_portimage_desc_value", $single = true);
$external_image_url  = get_post_meta($post->ID,'truethemes_external_image_url',true);

//prepare to get image
$thumb        = get_post_thumbnail_id();
$image_width  = 612;
$image_height = 792;

//truethemes image cropping script from framework/theme-functions.php
$image_src = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);
$html      = truethemes_generate_portfolio_image($image_src,$image_width,$image_height,$linkpost,$portfolio_full,$phototitle,'portrait-full'); 
?>

<div class="portfolio_portrait_full_last">
	<div class="modern_img_frame modern_portrait_full">
<?php if(!empty($image_src)): //there is either post thumbnail of external image ?>
		<div class="img-preload lightbox-img">
			<?php echo $html;?>
        </div><!-- END img-preload -->
<?php endif; ?>
	</div><!-- END image_frame -->
</div><!-- END column -->

<div class="portfolio_one_column">
	<?php the_title('<h3>', '</h3>'); the_content(); ?>
</div><!-- END portfolio_one_column -->

<div class="port_sep">
	<div class="hr_top_link"></div><a href="#" class="link-top"><?php _e('top','truethemes_localize'); ?></a>
</div><!-- END port_sep -->

<?php } //end non-filterable gallery metabox check

endwhile; endif; wp_pagenavi();  ?>
</main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>