<?php
// Comments template for pages

// Prevent Comments page from being accessed directly
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thank You!');


// Prevent Comments page from being displayed if password protected
if ( post_password_required() ) { ?> <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','truethemes_localize');//@since 3.0.3, made this translatable ?></p>
<?php return; }


// Get page comments status from custom metabox
global $post;
$page_comments_status = get_post_meta($post->ID,'page_comments',true); 


// Formatted Comments Function
function Karma_comments($comment, $args, $depth) { $GLOBALS['comment'] = $comment; ?>


<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
<div class="comment-wrap">
  <div class="comment-content" id="comment-<?php comment_ID(); ?>">
  	<div class="comment-gravatar">
  	<?php
  	//@since 3.0.3 modified by denzel to allow WordPress default gravatars
  	global $ttso; 
    $default_avatar_setting = $ttso->ka_default_avatar;
    if(empty($default_avatar_setting) || $default_avatar_setting == 'true'):  	
  		echo get_avatar($comment,$size='60',$default=get_template_directory_uri().'/images/_global/default-grav.jpg' ); 
  	else:
  		echo get_avatar($comment,$size='60');
  	endif;
  	?>
  	</div><!-- END comment-gravatar -->
  
  	<div class="comment-text">
	<span class="comment-author"><?php comment_author_link() ?></span> &nbsp;<span class="comment-date"><?php comment_date('F j, Y'); ?></span><br />
	<?php if ($comment->comment_approved == '0') : ?><?php _e('Your comment is awaiting moderation.','truethemes_localize') ?><?php endif; ?>
	<?php comment_text() ?>
	<?php comment_reply_link(array_merge( $args, array('reply_text' => __("reply","truethemes_localize"), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>  <?php edit_comment_link(__('edit','truethemes_localize'),' ','') ?>
    </div><!-- END comment-text -->   
  </div><!-- END comment-content -->
</div><!-- END comment-wrap -->
<?php }




function list_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>

<li>
<span class="comment-author"><?php comment_author_link() ?></span> &nbsp;<span class="comment-date"><?php comment_date('F j, Y'); ?></span><br />
<?php }

// If user turns on comments -> display them
if ('on' == $page_comments_status) :

if (have_comments()) :
$comment_count = count($comments_by_type['comment']);
($comment_count !== 1) ? $comment_txt = __('Comments','truethemes_localize') : $comment_txt = __('Comment','truethemes_localize');
$trackback_count = count($comments_by_type['pings']); 
($comment_count !== 1) ? $comment_txt_trackback = __('Trackbacks','truethemes_localize') : $comment_txt_trackback = __('Trackback','truethemes_localize'); ?>



<div class="tabs-area" id="blog-tabs">
	<h2><i class="fa fa-comments-o discussion-title"></i><?php _e('Comments','truethemes_localize'); ?></h2>
		<ul class="tabset">
			<li>
            <a href="#tab-0" class="tab"><span><?php echo "<strong>".$comment_count."</strong> &nbsp;".$comment_txt; ?></span></a>
            </li>
			<li>
            <a href="#tab-1" class="tab"><span><?php echo "<strong>".$trackback_count."</strong> &nbsp;".$comment_txt_trackback; ?></span></a>
            </li>
		</ul>
        
		<div id="tab-0" class="blog-tab-box">
			<?php if ( ! empty($comments_by_type['comment']) ) : ?>
            	<ol class="comment-ol" id="post-comments">
					<?php wp_list_comments('callback=Karma_comments&type=comment'); ?>
                </ol>
                
        <div class="comments-rss"><?php post_comments_feed_link(__('Subscribe to Comments','truethemes_localize')); ?></div><!-- END comments-rss -->

<!-- BEGIN COMMENTS PAGINATION -->
<div id="comments">
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
<nav id="comment-nav-below">
<div class="nav-next"><?php paginate_comments_links(); ?></div>
</nav>
<?php endif; // check for comment navigation ?>
</div>
<!-- END COMMENT PAGINATION -->


<?php endif; //end have_comments()
endif; //end have_comments() ?>



<div id="respond">

<?php if ( get_option('comment_registration') && !$user_ID) : ?>
<p>You must be<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> logged in</a> to post a comment.</p>
<?php else : ?>


<?php
//since version 3.0
//use WordPress comment_form function
//filtering of inputs are in framework/theme-functions.php
 
$defaults = array(
		'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'        => '<p class="comment-textarea-wrap"><label  class="comment-label" for="comment">' . __( 'Your Comments','truethemes_localize' ) . '</label><textarea name="comment" class="comment-textarea" tabindex="4" rows="5" cols="5" id="comment" aria-required="true"></textarea></p>',
		'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		
		//use admin_url('profile.php') instead of get_edit_user_link() which is WP 3.5 function.		
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),  admin_url('profile.php'), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'id_form'              => 'commentform',
		'id_submit'            => 'ka-comment-form-submit',
		'title_reply'          =>   '<h6 class="heading-horizontal tt-blog-related-post"><span><i class="fa fa-pencil-square-o" style="font-size:13px"></i>&nbsp;'.__( 'Add a Comment','truethemes_localize' ).'</span></h6>',
		'title_reply_to'       => __( 'Leave a Reply to %s','truethemes_localize' ),
		'cancel_reply_link'    => '<div class="comment-cancel">'.__( 'click here to cancel reply','truethemes_localize' ).'</div>',
		'label_submit'         => __( 'Add Comment','truethemes_localize' ),
	);

comment_form($defaults); 

?>



<?php endif; ?>
</div><!--end comment-response-->
<?php endif; ?>




<?php // Output Trackbacks
if (have_comments()) : ?>
</div>
<div id="tab-1" class="blog-tab-box">
<?php if ( ! empty($comments_by_type['pings']) ) : ?>
<ol class="commentlist">
<?php wp_list_comments('callback=list_pings&type=pings'); ?>
</ol>
<?php endif; ?>
</div>
</div>
<?php else : if ('open' == $post->comment_status) : else : endif; endif; ?>