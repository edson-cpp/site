<?php get_header();

global $ttso;
$ka_results_fallback = $ttso->ka_results_fallback;
?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main">
	<div class="main-area">
	<?php get_template_part('theme-template-part-tools','childtheme'); ?>

<main role="main" id="content">
<h2 class="search-title"><?php _e('Search Results for','truethemes_localize'); ?> "<?php the_search_query(); ?>"</h2><br />
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<ul class="search-list">
<li><strong><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></strong><br />
<?php
ob_start();
the_content();
$old_content = ob_get_clean();
$new_content = strip_tags($old_content);
echo substr($new_content,0,300).'...';
?>
</li>
</ul>

<?php endwhile; else: ?>
<?php echo $ka_results_fallback; ?>
<?php endif; ?>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</main><!-- END main #content -->

<aside role="complementary" id="sidebar" class="right_sidebar">
<?php dynamic_sidebar("Search Results Sidebar"); ?>
</aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>