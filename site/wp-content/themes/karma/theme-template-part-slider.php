<?php
/* 
-------------------------
Notes for Developers:
-------------------------

All page templates auto-unclude this file using get_template_part();

Page templates that do not pull in this file are:
- page.php
- index.php
- single.php
- template-filterable-gallery.php
- template_contact_googlemap.php
- template-portfolio-xx-columns.php  <-- all old gallery templates

Enjoy :)

*/

//grab custom page settings
global $post;
$post_id          			 	= $post->ID;
$karma_slider_type              = get_post_meta($post_id, 'karma_slider_type', true); //jquery slider type
$tt_karma_slider_category       = get_post_meta($post_id, 'tt_karma_slider_category',true); //jquery slider category
$tt_jquery3_slider_bg           = get_post_meta($post->ID, 'truethemes_slider_jq_bgcolor', true); //jquery slider (3) custom bg
$cu3er_page_slider              = get_post_meta($post_id, 'slider_3d_cu3er_id', true); //cu3er slider ID
$slider_custom_shortcode        = get_post_meta($post_id, 'slider_custom_shortcode', true); //slider shortcode (layerslider,etc)
$slider_disable_toolbar         = get_post_meta($post_id, 'slider_disable_toolbar',true); //checkbox- disable toolbar
$slider_full_width              = get_post_meta($post_id, 'truethemes_slider_full_width',true); //checkbox- fullwidth layerslider

//define new options for backward compatible
if ('' == $slider_custom_shortcode):  'null'    == $slider_custom_shortcode; endif;
if ('' == $slider_disable_toolbar):   'false'   == $slider_disable_toolbar; endif;

//define custom slider class for div#main
if ('null' != $karma_slider_type) $karma_slider_class   = $karma_slider_type;
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
	if ('karma-custom-jquery-3' == $karma_slider_type): ?>
    <div id="tt-slider-full-width"<?php if(!empty($tt_jquery3_slider_bg)):echo ' style="background-color: '.$tt_jquery3_slider_bg .'"';endif;?>>
		<?php get_template_part('theme-template-part-slider-jquery-3','childtheme');
	echo '</div>'; endif;
	
//custom slider (shortcode) full-width version
        if (('true' == $slider_full_width) && ('null' != $slider_custom_shortcode)): echo '<div id="tt-slider-full-width">';
			echo do_shortcode(''.$slider_custom_shortcode.'');
		echo '</div>'; endif;
	?>
<div class="main-area">
<?php
    
//jquery1 slider
    if ('karma-custom-jquery-1' == $karma_slider_type): get_template_part('theme-template-part-slider-jquery-1','childtheme'); endif;
    
//custom slider (shortcode)
    if (('null' != $slider_custom_shortcode) && empty($slider_full_width)): echo do_shortcode(''.$slider_custom_shortcode.''); endif;
    
//utility bar (breadcrumbs, etc)
    if ( ('true' == $slider_disable_toolbar) || (is_page_template('template-blank-canvas.php')) ): //do nothing
    else: get_template_part('theme-template-part-tools','childtheme'); endif;
    
    ?>