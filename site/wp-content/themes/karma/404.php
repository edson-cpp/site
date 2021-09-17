<?php
get_header();

//grab custom page settings
global $ttso;
$ka_404title   = stripslashes($ttso->ka_404title);
$ka_404message = stripslashes($ttso->ka_404message);
?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main">
	<div class="main-area">
		<?php get_template_part('theme-template-part-tools','childtheme'); ?>
        	
            <main role="main" id="content" class="content_full_width">
            	<div class="four_error">
                	<div class="four_message">
                    	<h1 class="four_o_four"><?php echo $ka_404title;?></h1>
							<?php echo $ka_404message;?>
                    </div><!-- END four_message -->
                </div><!-- END four_error -->
            </main><!-- END main #content -->
        </div><!-- END main-area -->
        
<?php get_footer(); ?>