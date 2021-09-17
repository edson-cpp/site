<?php get_header(); ?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php
global $ttso;
$ka_blogtitle             = $ttso->ka_blogtitle;
$ka_searchbar             = $ttso->ka_searchbar;
$ka_crumbs                = $ttso->ka_crumbs;
$ka_blogauthor            = $ttso->ka_blogauthor;
$ka_related_posts         = $ttso->ka_related_posts;
$ka_related_posts_title   = $ttso->ka_related_posts_title;
$ka_related_posts_count   = $ttso->ka_related_posts_count;
$ka_posted_by             = $ttso->ka_posted_by;
$ka_post_date             = $ttso->ka_post_date;
$ka_dragshare             = $ttso->ka_dragshare;
$show_post_comments       = $ttso->ka_post_comments;
$show_tools_panel         = $ttso->ka_tools_panel;
$social_sharing           = $ttso->ka_blog_social_sharing;
?>

<?php truethemes_before_main_hook();// action hook ?>

<div id="main">
	<div class="main-area">
    
<?php //check site options for utility panel
if('false' != $show_tools_panel): ?>

<div class="tools">
	<span class="tools-top"></span>
        <div class="frame">
        <?php truethemes_before_article_title_hook();// action hook 
		
		//print page title
		echo '<h1>'.$ka_blogtitle.'</h1>';
		
		//display search box
		if ($ka_searchbar == "true"){get_template_part('searchform','childtheme');}
		
		//display breadcrumbs
		if ($ka_crumbs == "true") { $bc = new simple_breadcrumb; }
		
		// action hook
		truethemes_after_searchform_hook(); ?>
        
        </div><!-- END frame -->
	<span class="tools-bottom"></span>
</div><!-- END tools -->
<?php endif; ?>

  <main role="main" id="content" class="content_blog">
    <?php
//@since 3.0.3, modified by denzel, we do this only if WPML is installed, 
//or exclude category will not work for other languages on posts page.
//This is a WPML issue, not sure why it does not obey pre_get_posts hook.
if(defined('ICL_LANGUAGE_CODE')):
	//check and do this only on posts page, or we will mess up archives and categories.
	global $wp_query;
	if($wp_query->is_posts_page == true):
	    //This is the page number
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	    //get excluded category from site option.	
		$exclude = B_getExcludedCats();
		//this is 'Blog pages show at most option' in wp admin > settings > reading	
		$post_per_page = get_option('posts_per_page');
		//custom query string. 
		$query_string ="posts_per_page=$post_per_page&cat=$exclude&paged=$paged";
		query_posts($query_string);
	endif;
endif;

if (have_posts()) : while (have_posts()) : the_post(); 

//retrieve all post meta of posts in the loop.
$linkpost           = get_post_meta($post->ID, "_jcycle_url_value", $single = true);
$external_image_url = get_post_meta($post->ID,'truethemes_external_image_url',true);
$video_url          = get_post_meta($post->ID,'truethemes_video_url',true);
$permalink          = get_permalink($post->ID);

//prepare to get image
$thumb              = get_post_thumbnail_id();
$image_width        = 538;
$image_height       = 218;

//use truethemes image croping script
$image_src = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);

//define post_class
//http://codex.wordpress.org/Template_Tags/post_class
//http://codex.wordpress.org/Function_Reference/get_post_class
$array_post_classes = get_post_class(); 
$post_classes = '';
foreach($array_post_classes as $post_class){
$post_classes .= " ".$post_class;
}

//post title and permalink for "drag-to-share"
global $post; 
$post_title = get_the_title($post->ID);
$permalink  = get_permalink($post->ID);
?>

<article class="single_blog_wrap <?php echo $post_classes;if ('' == ($video_url || $external_image_url || $thumb)):echo ' tt-blog-no-feature';endif;?>">
<div class="post_title">
<?php truethemes_begin_single_post_title_hook(); // action hook ?>

<?php if ('' == $linkpost): ?>
<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> <?php else: ?>

<h2><a href="<?php echo $linkpost; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2> <?php endif; ?>

<?php if ('true' != $ka_posted_by): ?>
<p class="posted-by-text"><span><?php _e('Posted by:', 'truethemes_localize') ?></span> <?php the_author_posts_link(); ?></p> <?php endif; ?>

<?php truethemes_end_single_post_title_hook(); // action hook ?>
</div><!-- END post_title -->

<div class="post_content">
<?php truethemes_begin_single_post_content_hook(); // action hook ?>

<?php
//generate image using custom function
//find this function near line 122 of /framework/theme-functions.php
$html = truethemes_generate_blog_image($image_src,$image_width,$image_height,$blog_image_frame,$linkpost,$permalink,$video_url);
echo $html;

//display the content
the_content();
get_template_part('theme-template-part-inline-editing','childtheme');

if(function_exists('truethemes_link_pages')){ truethemes_link_pages(); }else{ wp_link_pages();} 

//display "shareaholic" plugin if present
if(function_exists('selfserv_shareaholic')) { selfserv_shareaholic(); }
?>

<?php //drag-to-share
if ('true' == $ka_dragshare):
echo "<a class='post_share sharelink_small' href='$permalink' data-gal='prettySociable'>Share</a>";
endif;

//previous_post_link( '%link', '<div class="meta-nav"> &larr; %title</div>', false );

//display post date if true
if ('true' != $ka_post_date): ?>
<div class="post_date">
	<span class="day"><?php the_time('j'); ?></span>
    <br />
    <span class="month"><?php echo strtoupper(get_the_time('M')); ?></span>
</div><!-- END post_date -->

<div class="post_comments">
<a href="<?php echo the_permalink().'#post-comments'; ?>"><span><?php comments_number('0', '1', '%'); ?></span></a>
</div><!-- END post_comments -->
<?php endif;

//action hook
truethemes_end_single_post_content_hook(); ?>
</div><!-- END post_content -->

<?php if ('true' == $ka_blogauthor): //display about-the-author if true ?>
<div id="about-author-wrap"<?php if('true' == $social_sharing): echo ' class="social-sharing-active"';endif;?>>
  <div class="comment-content">
  	<div class="comment-gravatar"><?php echo get_avatar(get_the_author_meta('email'),$size='80',$default=get_template_directory_uri().'/images/_global/default-grav.jpg' ); ?>
  	</div><!-- END comment-gravatar -->
  
  	<div class="comment-text">
    <p class="comment-author-about"><?php _e('About the Author:', 'truethemes_localize') ?></p>
    <?php the_author_meta('description'); ?>
    </div><!-- END comment-text -->
    
  </div><!-- END comment-content -->
</div><!-- END about-author-wrap -->
<?php endif; //end about-the-author

//@since 4.0 - social sharing
if('true' == $social_sharing): ?>
<ul class="social_icons tt_vector_social_icons tt_vector_social_color tt_show_social_title tt_image_social_icons">
<li><a class="twitter" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>"><?php _e('Share on Twitter', 'truethemes_localize') ?></a></li>

<li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"><?php _e('Share on Facebook', 'truethemes_localize') ?></a></li>

<li><a class="google" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"><?php _e('Share on Google', 'truethemes_localize') ?></a></li>
</ul>
<?php endif;// end social sharing

//related posts
if ('true' == $ka_related_posts):

$tags = wp_get_post_tags($post->ID);
if ($tags) { $tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$args=array(
'tag__in'           => $tag_ids,
'post__not_in'      => array($post->ID),
'showposts'         => $ka_related_posts_count,  // Number of related posts that will be shown.
'caller_get_posts'  =>1
);

$my_query = new wp_query($args);
	if( $my_query->have_posts() ) {
		echo '<h6 class="heading-horizontal tt-blog-related-post"><span><i class="fa fa-file-text-o" style="font-size:13px"></i>&nbsp; '.$ka_related_posts_title.'</span></h6><ul class="list list1 tt-blog-related-post-list">';
		while ($my_query->have_posts()) {
			$my_query->the_post();
?>
<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php }
}
echo '</ul>'; }
$post = $backup;
wp_reset_query();

endif; //end related_posts loop
?>
</article><!-- END single_blog_wrap -->

<?php 
/*
* Add check on whether to disable comments througout site.
*/
if('false' !=  $show_post_comments): comments_template('', true); endif;

//start end loop
endwhile; else: ?>
<h2><?php _e('Nothing Found', 'truethemes_localize') ?></h2>
<p><?php  _e('Sorry, it appears there is no content in this section.', 'truethemes_localize') ?></p>
<?php endif; //end loop

if(function_exists('wp_pagenavi')): wp_pagenavi(); else: paginate_links(); endif;
?>
</main><!-- END main #content -->

<aside role="complementary" id="sidebar" class="sidebar_blog">
<?php dynamic_sidebar("Blog Sidebar"); ?>
</aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>