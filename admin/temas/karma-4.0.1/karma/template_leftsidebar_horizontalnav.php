<?php
/*
Template Name: Left Sidebar
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' ); 

//grab custom menu settings
$custom_menu_slug  = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
$sub_menu_toggle   = get_post_meta($post->ID, 'truethemes_page_checkbox',true);
   
		//horizontal sub-menu (when checked, value = "on")
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

<main role="main" id="content" class="content_left_sidebar content_no_subnav">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
get_template_part('theme-template-part-inline-editing','childtheme');
comments_template('/page-comments.php', true); ?>
</main><!-- END main #content -->

<aside role="complementary" id="sidebar" class="left_sidebar">
<?php generated_dynamic_sidebar(); ?>
</aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>