<?php
/*
Template Name: Right Nav
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' ); 

//grab custom menu settings
$custom_menu_slug = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
?>

<nav role="navigation" id="sub_nav" class="nav_right_sub_nav">
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
		
		//check for custom sidebar on this page
		global $post;
		$custom_sidebar = get_post_meta($post->ID,'sbg_selected_sidebar_replacement',true);
		if(!empty($custom_sidebar[0])):
	?>
    <div class="sub_nav_sidebar">
    <?php generated_dynamic_sidebar(); ?>
    </div><!-- END sub_nav_sidebar -->
    <?php endif; //end custom sidebar check ?>
</nav><!-- END sub_nav -->

<?php
function removeEmptyTags($html_replace)
{
$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";
return preg_replace($pattern, '', $html_replace);
}
?>

<main role="main" id="content" class="content-right-nav">
<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif;
get_template_part('theme-template-part-inline-editing','childtheme');
comments_template('/page-comments.php', true); ?>
</main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>