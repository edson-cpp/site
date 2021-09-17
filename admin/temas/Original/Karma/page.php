<?php get_header();

/*------------------------------------------------*/
/* If WooCommerce "Cart" - we load custom layout
/*------------------------------------------------*/
if (class_exists('woocommerce') && ((is_woocommerce() == "true") || (is_checkout() == "true") || (is_cart() == "true") || (is_account_page() == "true") )):

//grab Woo values from Site Options Panel
global $ttso;
$woocommerce_layout       = $ttso->ka_woocommerce_layout;
$woocommerce_tools_panel  = $ttso->ka_woocommerce_tools_panel;

//pre-define values for backward-compatible
if ('' == $woocommerce_layout): 'Right Sidebar' == $woocommerce_layout; endif;
if ('' == $woocommerce_tools_panel): 'true'     == $woocommerce_tools_panel; endif;
?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook(); //action hook ?>

<div id="main" class="tt-woocommerce">
	<div class="main-area">

<?php 
if ('true' == $woocommerce_tools_panel) {
get_template_part('theme-template-part-tools-woocommerce','childtheme');
}

//if Right Sidebar
if ('Right Sidebar' == $woocommerce_layout): echo '<main role="main" id="content">'; endif;


//if Left Sidebar
if ('Left Sidebar' == $woocommerce_layout): echo '<main role="main" id="content" class="content_left_sidebar">'; endif;


//if Full-Width
if ('Full Width' == $woocommerce_layout): echo '<main role="main" id="content" class="content_full_width">'; endif;


if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
comments_template('/page-comments.php', true);
?>
</main><!-- END main #content -->


<?php 
//if Right Sidebar
if ('Right Sidebar' == $woocommerce_layout): 

echo '<aside role="complementary" id="sidebar" class="right_sidebar">';

if ( (is_cart() == "true") || (is_checkout() == "true") ) {
			dynamic_sidebar("WooCommerce - Cart + Checkout");
		} else {
			dynamic_sidebar("WooCommerce Sidebar");
		}

echo'</aside><!-- END .right_sidebar-->';

endif;


//if Left Sidebar
if ('Left Sidebar' == $woocommerce_layout): 

echo '<aside role="complementary" id="sidebar" class="left_sidebar">';

if ( (is_cart() == "true") || (is_checkout() == "true") ) {
			dynamic_sidebar("WooCommerce - Cart + Checkout");
		} else {
			dynamic_sidebar("WooCommerce Sidebar");
		}

echo'</aside><!-- END .left_sidebar-->';

endif;

echo '</div><!-- END main-area -->';
?>

  
<?php 
else:
/*------------------------------------------------*/
/* ELSE we load normal layout
/*------------------------------------------------*/
  
//grab custom page settings
$karma_slider_type              = get_post_meta($post->ID, 'karma_slider_type', true);
$cu3er_page_slider              = get_post_meta($post->ID, 'slider_3d_cu3er_id', true);
$slider_custom_shortcode        = get_post_meta($post->ID, 'slider_custom_shortcode', true);
$custom_menu_slug               = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
$slider_disable_toolbar         = get_post_meta($post->ID, 'slider_disable_toolbar',true);
$tt_karma_slider_category       = get_post_meta($post->ID, 'tt_karma_slider_category',true);
$sub_menu_toggle                = get_post_meta($post->ID, 'truethemes_page_checkbox',true);
$slider_full_width              = get_post_meta($post->ID, 'truethemes_slider_full_width',true);
$parallax_banner_enable         = get_post_meta($post->ID, 'truethemes_parallax_banner',true);     //checkbox - enable parallax banner
$parallax_banner_bgcolor        = get_post_meta($post->ID, 'truethemes_parallax_bgcolor',true);    //parallax banner bgcolor
$parallax_banner_bgimage        = get_post_meta($post->ID, 'truethemes_parallax_bgimage',true);    //parallax banner bgimage
$parallax_banner_padding        = get_post_meta($post->ID, 'truethemes_parallax_padding',true);    //parallax banner padding (height)
$parallax_banner_text           = get_post_meta($post->ID, 'truethemes_parallax_text',true);       //parallax banner text

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
	<?php
	//jquery3 slider
	if ('karma-custom-jquery-3' == $karma_slider_type): echo '<div id="tt-slider-full-width">';
		get_template_part('theme-template-part-slider-jquery-3','childtheme');
	echo '</div>'; endif;
	
	//custom slider (shortcode) full-width version
        if (('true' == $slider_full_width) && ('null' != $slider_custom_shortcode)): echo '<div id="tt-slider-full-width">';
			echo do_shortcode(''.$slider_custom_shortcode.'');
		echo '</div>'; endif;

//parallax banner
	if ('true' == $parallax_banner_enable): ?>
    <section id="tt-parallax-banner" data-type="background" data-speed="5" style="padding:<?php echo $parallax_banner_padding; ?> 0;<?php if(!empty($parallax_banner_bgcolor)):echo ' background-color:'.$parallax_banner_bgcolor .';';endif;if(!empty($parallax_banner_bgimage)):echo ' background-image:url('.$parallax_banner_bgimage.')';endif;?>;">
		<?php if(!empty($parallax_banner_text)):echo '<div class="tt-parallax-text" style="display:none;">'.wpautop($parallax_banner_text).'</div>';endif;//end banner_text check
	echo '</section>'; endif;
?>
	<div class="main-area">
		<?php
		
        //jquery1 slider
        if ('karma-custom-jquery-1' == $karma_slider_type): get_template_part('theme-template-part-slider-jquery-1','childtheme'); endif;
        
        //custom slider (shortcode)
        if (('null' != $slider_custom_shortcode) && empty($slider_full_width)): echo do_shortcode(''.$slider_custom_shortcode.''); endif;
        
        //utility bar (breadcrumbs, etc)
        if ('true' == $slider_disable_toolbar): //do nothing
        else: get_template_part('theme-template-part-tools','childtheme'); endif;
   
		///horizontal sub-menu (when checked, value = "on")
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
							'depth'     => 0,
							"menu"      => "$custom_menu_slug",
							'walker'    => "" 
						));
						 echo '</ul>'; 
					endif;
				 ?>
		</div><!-- END horizontal_nav -->
		<?php endif; //end horizontal_nav ?>
    
    <main role="main" id="content" class="content_full_width">
    <?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
    comments_template('/page-comments.php', true);
    get_template_part('theme-template-part-inline-editing','childtheme'); ?>
    </main><!-- END main #content -->
</div><!-- END main-area -->
    
<?php endif; //end WooCommerce layout
get_footer();  ?>