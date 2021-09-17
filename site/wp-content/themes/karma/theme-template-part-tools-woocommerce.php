<?php 
global $ttso;
$woocommerce_breadcrumbs = $ttso->ka_woocommerce_breadcrumbs;
$woocommerce_searchbar   = $ttso->ka_woocommerce_searchbar;
$woocommerce_title       = $ttso->ka_woocommerce_title;
$show_tools_panel        = $ttso->ka_tools_panel;
?>

<?php
//set to "yes" so > Karma 3.0 themes won't need to save page in order to show search
if ('' == $ka_search_perpage): 'yes' == $ka_search_perpage = "yes"; endif;

if('false' != $show_tools_panel): ?>

<div class="tools">
<div class="holder">
<div class="frame">

<?php truethemes_before_article_title_hook();// action hook ?>

<h1><?php echo $woocommerce_title; ?></h1>
<?php if ($woocommerce_searchbar == "true"){get_template_part('searchform','childtheme');} ?>
<?php if ($woocommerce_breadcrumbs == "true"){ ?><p class="breadcrumb"><?php tt_woo_breadcrumbs(); ?></p><?php } ?>

<?php truethemes_after_searchform_hook();// action hook ?>

</div><!-- END frame -->
</div><!-- END holder -->
</div><!-- END tools -->
<?php endif; ?>