<?php
truethemes_before_footer_top(); //action hook introduced in 4.0 for wp-activate.php, do not remove
add_filter('pre_get_posts','wploop_exclude'); 

// retrieve values from site options panel
'' == $ka_copyright;
global $ttso;
$boxedlayout            = $ttso->ka_boxedlayout;
$footer_layout          = $ttso->ka_footer_layout;
$ka_footer_columns      = $ttso->ka_footer_columns;
$footer_callout_main    = $ttso->ka_footer_callout_main;
$footer_callout_content = $ttso->ka_footer_callout_content;
$footer_callout_link    = $ttso->ka_footer_callout_link;
$ka_scrolltoplink       = $ttso->ka_scrolltoplink;
$ka_scrolltoptext       = $ttso->ka_scrolltoplinktext;
$ka_copyright           = $ttso->ka_footer_copyright;

//pre-define options for backward-compatible
if ('' == $ka_copyright): $ka_copyright = 'true'; endif;
?>

<div id="footer-top">&nbsp;</div><!-- END footer-top -->
</div><!-- END main -->

        <footer role="contentinfo" id="footer">
        	<?php if('true' == $footer_callout_main): ?>
            <div id="footer-callout" <?php if(!empty($footer_callout_link)): ?>class="default-callout-link"<?php endif; ?>>
            	<div id="footer-callout-content">
                	<?php if(!empty($footer_callout_link)): ?><a href="<?php echo $footer_callout_link; ?>" class="footer-callout-link"><?php endif; ?>
                    	<?php echo stripslashes($footer_callout_content); ?>
                    <?php if(!empty($footer_callout_link)): ?></a><?php endif; ?>
                </div><!-- END footer-callout-content -->
            </div><!-- END footer-callout -->
            <?php endif; //end $footer_callout_main ?>
            
            <div class="footer-overlay">
				<?php truethemes_begin_footer_hook(); // action hook
                if (($footer_layout == "full_bottom") || ($footer_layout == "full")){ ?>
                
                <div class="footer-content">
                <?php $footer_columns = range(1,$ka_footer_columns);$footer_count = 1;$sidebar = 6;
                foreach ($footer_columns as $footer => $column){
                $class = ($ka_footer_columns == 1) ? '' : '';
                $class = ($ka_footer_columns == 2) ? 'one_half' : $class;
                $class = ($ka_footer_columns == 3) ? 'one_third' : $class;
                $class = ($ka_footer_columns == 4) ? 'one_fourth' : $class;
                $class = ($ka_footer_columns == 5) ? 'one_fifth' : $class;
                $class = ($ka_footer_columns == 6) ? 'one_sixth' : $class; 
                $lastclass = (($footer_count == $ka_footer_columns) && ($ka_footer_columns != 1)) ? '_last': '';
                ?><div class="<?php echo $class.$lastclass; ?> tt-column"><?php dynamic_sidebar($sidebar) ?></div><?php $footer_count++; $sidebar++; } ?>
                </div><!-- END footer-content -->
            </div><!-- END footer-overlay -->
            
        <?php } else {echo '<br />';} if (($footer_layout == "full_bottom") || ($footer_layout == "bottom")){ ?>
        
        <div id="footer_bottom">
            <div class="info">
            	<?php if ('true' == $ka_copyright): ?>
                <div id="foot_left">&nbsp;<?php truethemes_begin_footer_left_hook();// action hook ?>
                    <?php 
						if(is_active_sidebar(12)): dynamic_sidebar("Footer Copyright - Left Side");
							elseif(get_theme_mod('footer_copyright_textbox')): echo get_theme_mod('footer_copyright_textbox'); 
						else:
							_e('Add Copyright in Wordpress Dashboard: <a href="'.admin_url( 'customize.php' ).'">Appearance > Customize</a>', 'truethemes_localize');
						endif;
					?>
                    
                </div><!-- END foot_left -->
                <?php endif; //end footer_copyright check ?>
              
                <div id="foot_right">
                    <?php if ($ka_scrolltoplink == "true"){ echo '<div class="top-footer"><a href="#" class="link-top">'.$ka_scrolltoptext.'</a></div>'; }
                    // Check to see if user has footer menu set, if so display it 
                    if(has_nav_menu('Footer Navigation')): ?>
                    <ul>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'Footer Navigation' ,
                        'depth'          => 0 ,
                        'container'      => false)); ?>
                    </ul>
                    <?php elseif(is_active_sidebar(13)): ?>
                    <ul><?php dynamic_sidebar("Footer Menu - Right Side"); ?></ul>
                    <?php endif; truethemes_end_footer_right_hook()// action hook ?>       
                </div><!-- END foot_right -->
            </div><!-- END info -->
        </div><!-- END footer_bottom -->
        <?php } //end footer_bottom check ?>
        </footer><!-- END footer -->
        
	</div><!-- END wrapper -->
</div><!-- END tt-layout -->
<?php wp_footer(); ?>

<?php //check for parallax banner
global $post;
$parallax_banner_enable = get_post_meta($post->ID, 'truethemes_parallax_banner',true);     //checkbox - enable parallax banner
if ('true' == $parallax_banner_enable): ?>
<script>
jQuery(document).ready(function () {
    jQuery('.tt-parallax-text').fadeIn(1000); //delete this to remove fading content

    var $window = jQuery(window);
    jQuery('section[data-type="background"]').each(function () {
        var $bgobj = jQuery(this);

        jQuery(window).scroll(function () {
            var yPos = -($window.scrollTop() / $bgobj.data('speed'));
            var coords = '50% ' + yPos + 'px';
            $bgobj.css({
                backgroundPosition: coords
            });
        });
    });
});
</script>
<?php endif;//end parallax check ?>


<!--[if !IE]><!--><script>
if (/*@cc_on!@*/false) {
    document.documentElement.className+=' ie10';
}
</script><!--<![endif]-->
</body>
</html>