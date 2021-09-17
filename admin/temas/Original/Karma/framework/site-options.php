<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

// VARIABLES
	$themename = "Karma";
	$shortname = "ka";
	
// Populate siteoptions option in array for use in theme
	global $of_options;
	$of_options = get_option('of_options');
	$GLOBALS['template_path'] = TRUETHEMES_FRAMEWORK;
	
//Access the WordPress Categories via an Array
	$of_categories                  = array();  
	$of_categories_obj              = get_categories('hide_empty=0');
	foreach ($of_categories_obj as $of_cat) {
	$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
	$categories_tmp                 = array_unshift($of_categories, "Select a category:");    
	
//Access the WordPress Pages via an Array
	$of_pages = array();
	$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
	foreach ($of_pages_obj as $of_page) {
	$of_pages[$of_page->ID] = $of_page->post_name; }
	$of_pages_tmp = array_unshift($of_pages, "Select the Blog page:");       
	
// Image Alignment radio box
	$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
	
// Image Links to Options
	$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//More Options
	$uploads_arr      = wp_upload_dir();
	$all_uploads_path = $uploads_arr['path'];
	$all_uploads      = get_option('of_uploads');
	$other_entries    = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
	$body_repeat      = array("no-repeat","repeat-x","repeat-y","repeat");
	$body_pos         = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

//Footer Columns Array
	$footer_columns = array("1","2","3","4","5","6");

//Paths for "type" => "images" - @since 4.0 all images stored in same directory
	$image_url    =  get_template_directory_uri() . '/framework/admin/images/site-option-images/';

//Access the WordPress Categories via an Array
	$exclude_categories = array();  
	$exclude_categories_obj = get_categories('hide_empty=0');
	foreach ($exclude_categories_obj as $exclude_cat) {
	$exclude_categories[$exclude_cat->cat_ID] = $exclude_cat->cat_name;}



/*-----------------------------------------------------------------------------------*/
/* Create Site Options Array */
/*-----------------------------------------------------------------------------------*/
$options = array();	


/* General Settings */
$options[] = array(
			"name" => __('General','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"	 => __('General Settings','truethemes_localize'),
			"std"	 => __('A handful of powerful settings to improve user experience.','truethemes_localize'),
			"class"  => "heading-parent",
			"type"   => "info");
			
$options[] = array(
			"name" => __('Activate Karma 4.0','truethemes_localize'),
			"desc" => __('Check this box to activate Karma 4.0. This will improve your theme experience by cleaning up any old page templates and settings that are no longer needed by Karma 4.0.<br /><em>(Users upgrading from older versions of Karma should not check this box. You will need the old page templates and settings for proper functioning of your website.)</em>','truethemes_localize'),
			"id"   => $shortname."_activate_karma4",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Disable TimThumb Image Resizing','truethemes_localize'),
			"desc" => __('Check this box to disable the TimThumb image re-sizing script. The TimThumb script gets activated whenever displaying an image which has (not) been uploaded to the WordPress media library. This option is provided for users who wish to crop their own externally-hosted images. If you\'ve activated this option and images are not loading correctly kindly uncheck this checkbox to return the TimThumb script back into the theme.','truethemes_localize'),
			"id"   => $shortname."_deactivate_timthumb",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('SEO Module','truethemes_localize'),
			"desc" => __('Check this box to enable a fully optimized SEO Module for this theme. <em>Please disable all other SEO plugins before activating to prevent any possible conflicts.</em>','truethemes_localize'),
			"id"   => $shortname."_seo_module",
			"std"  => "false",
			"type" => "checkbox");	
			
$options[] = array(
			"name" => __('Meta Boxes','truethemes_localize'),
			"desc" => __('This functionality hides meta boxes in the Dashboard to help Wordpress feel more like a CMS. This includes: Comments, Discussion, Trackbacks, Custom Fields, Author, and Slug. <em>Un-check this box to disable this functionality.</em>','truethemes_localize'),
			"id"   => $shortname."_hidemetabox",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Inline Editing','truethemes_localize'),
			"desc" => __('This functionality adds an inline-editing button to all pages & posts so that logged-in administrators can quickly and easily edit their website. <em>Un-check this box to disable this functionality.</em>','truethemes_localize'),
			"id"   => $shortname."_inline_editing",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name"  => __('Custom Code','truethemes_localize'),
			"std"   => __('Easily add Custom CSS Code or other scripts to your website.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");	
			
$options[] = array(
			"name" => __('Custom CSS Code','truethemes_localize'),
			"desc" => __('Use this area to add custom CSS code to your website. This code will automatically be inserted between &lt;style&gt; tags','truethemes_localize'),
			"id"   => $shortname."_custom_css",
			"type" => "textarea");
			
$options[] = array(
			"name" => __('Custom Scripts &lt;/head&gt;','truethemes_localize'),
			"desc" => __('Use this section to add custom scripts to your website. The scripts entered in this field will be placed before the &lt;/head&gt; tag.','truethemes_localize'),
			"id"   => $shortname."_customcode_head",
			"type" => "textarea");
			
/* un-comment and delete option below for link to one-page-nav (needs more work before public launch) 

$options[] = array(
			"name" => __('Custom Scripts &lt;/body&gt;','truethemes_localize'),
			"desc" => __('Use this section to add custom scripts to your website.<br />The scripts entered in this field will be placed before the &lt;/body&gt; tag.<br /><a href="http://s3.truethemes.net/theme-xml-content/wp-karma-4/karma-onepage-nav.txt" target="_blank">Here\'s the script for a single-page side navigation.</a>','truethemes_localize'),
			"id"   => $shortname."_customcode_body",
			"type" => "textarea");
*/
			
$options[] = array(
			"name" => __('Custom Scripts &lt;/body&gt;','truethemes_localize'),
			"desc" => __('Use this section to add custom scripts to your website.<br />The scripts entered in this field will be placed before the &lt;/body&gt; tag.','truethemes_localize'),
			"id"   => $shortname."_customcode_body",
			"type" => "textarea");
			
$options[] = array(
			"name" => __('Tracking Code','truethemes_localize'),
			"desc" => __('Paste Google Analytics (or other) tracking code here.','truethemes_localize'),
			"id"   => $shortname."_google_analytics",
			"type" => "textarea");
			
$options[] = array(
			"name"  => __('Boxed Layout','truethemes_localize'),
			"std"   => __('Switch to a Boxed Layout Design using the settings below. Please note that all settings below are only visible when Boxed Layout is enabled.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Enable Boxed Layout','truethemes_localize'),
			"desc" => __('Check this box to switch to a Boxed Layout Design.','truethemes_localize'),
			"id"   => $shortname."_boxedlayout",
			"std"  => "false",
			"type" => "checkbox");		
			
$options[] = array(
			"name" => __('Drop Shadow','truethemes_localize'),
			"desc" => __('Set the opacity of the Boxed Layout drop shadow.<br /><em>Values from: 0.1 - 1.0</em>','truethemes_localize'),
			"id"   => $shortname."_boxedlayout_shadow",
			"std"  => "0.5",
			"type" => "text");
					
$options[] = array(
			"name" =>  __('Body Background Color','truethemes_localize'),
			"desc" => __('Specify a background color for the &lt;body&gt; element of your website.','truethemes_localize'),
			"id"   => $shortname."_body_bg_color",
			"type" => "color");
					
$options[] = array(
			"name" => __('Body Background Image','truethemes_localize'),
			"desc" => __('Select a custom background image for the &lt;body&gt; element of your website (or upload custom image below)','truethemes_localize'),
			"id"      => $shortname."_select_body_bg",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
				'null'               => $image_url . 'none.png',
				'classy-fabric'      => $image_url . 'body-bg-classy-fabric.png',
				'low-contrast-linen' => $image_url . 'body-bg-low-contrast-linen.png',
				'dark-wall'          => $image_url . 'body-bg-dark-wall.png',
				'darkdenim3'         => $image_url . 'body-bg-darkdenim3.png',		
				'pinstriped_suit'    => $image_url . 'body-bg-pinstriped_suit.png',
				'connect'            => $image_url . 'body-bg-connect.png',
				'escheresque'        => $image_url . 'body-bg-escheresque.png',
				'gplaypattern'       => $image_url . 'body-bg-gplaypattern.png',
				'grey-subtle-noise'  => $image_url . 'body-bg-grey-subtle-noise.png',
				'grey'               => $image_url . 'body-bg-grey.png',
				'grid_noise'         => $image_url . 'body-bg-grid_noise.png',
				'grid'               => $image_url . 'body-bg-grid.png',
				'hexellence'         => $image_url . 'body-bg-hexellence.png',
				'lghtmesh'           => $image_url . 'body-bg-lghtmesh.png',
				'noise_lines'        => $image_url . 'body-bg-noise_lines.png',
				'noisy_grid'         => $image_url . 'body-bg-noisy_grid.png',
				'rough_diagonal'     => $image_url . 'body-bg-rough_diagonal.png',
				'shattered'          => $image_url . 'body-bg-shattered.png',
				'subtle_dots'        => $image_url . 'body-bg-subtle_dots.png',
				'tiny_grid'          => $image_url . 'body-bg-tiny_grid.png'
				));				
					
$options[] = array(
			"name" => __('Custom Upload','truethemes_localize'),
			"desc" => __('Upload a custom background image. Free backgrounds can be downloaded from <a href="http://www.subtlepatterns.com" target="_blank">www.subtlepatterns.com</a>','truethemes_localize'),
			"id"   => $shortname."_body_bg_image", 
			"type" => "upload");
			
			
$options[] = array(
			"name" => __('Background Image Position','truethemes_localize'),
			"desc" => __('Set the background-position property for the custom background image.','truethemes_localize'),
			"id"      => $shortname."_designer_page_background_position",
			"type"    => "select",
			"options" => array(
				'left top'      => 'left top',
				'center top'    => 'center top',
				'right top'     => 'right top',
				'center center' => 'center center',
				'left bottom'   => 'left bottom',
				'center bottom' => 'center bottom',
				'right bottom'  => 'right bottom',
				));			
				
$options[] = array(
			"name" => __('Background Image Repeat','truethemes_localize'),
			"desc" => __('Set the background-repeat property for the custom background image.','truethemes_localize'),
			"id"      => $shortname."_designer_page_background_repeat",
			"type"    => "select",
			"options" => array(
				'repeat'    => 'repeat',
				'repeat-x'  => 'repeat-x',
				'repeat-y'  => 'repeat-y',
				'no-repeat' => 'no-repeat',
				));
				
$options[] = array(
			"name" => __('Enable Fixed Background Image','truethemes_localize'),
			"desc" => __('Check this box to make the body background image fixed.','truethemes_localize'),
			"id"      => $shortname."_designer_page_background_fixed",
			"type"    => "checkbox",
			"std"    => "false");
			
//filter to allow developer to add new options to this section.
$options = apply_filters('theme_option_general_settings',$options);
			


/*-----------------------------------------------------------------------------------*/
/* Create Mobile Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Mobile','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Mobile Settings','truethemes_localize'),
			"std"   => __('Specify how your website will behave when viewed on mobile devices.','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");

$options[] = array(
			"name" => __('Disable Responsive Design','truethemes_localize'),
			"desc" => __('Check this box to disable Karma\'s responsive design. A Responsive Design makes your website mobile-friendly by adjusting the page layout according to the mobile device.','truethemes_localize'),
			"id"   => $shortname."_responsive",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Mobile Menu','truethemes_localize'),
			"desc" => __('This text is displayed next to the Mobile Menu button. <em>(main menu)</em>','truethemes_localize'),
			"id"   => $shortname."_mobile_menu_text",
			"std"  => "Main Menu",
			"type" => "text");		
			
$options[] = array(
			"name" => __('Disable Subpages','truethemes_localize'),
			"desc" => __('Check this box to disable subpages in the Mobile Menu. <em>(main menu)</em>','truethemes_localize'),
			"id"   => $shortname."_mobile_menu_subs",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Mobile Sub Menu','truethemes_localize'),
			"desc" => __('The Sub Menu on left-nav and right-nav page templates converts to a dropdown list on small mobile devices. This text is displayed as the first option in the dropdown list','truethemes_localize'),
			"id"   => $shortname."_mobile_sub_menu_text",
			"std"  => "More in this section...",
			"type" => "text");
			
$options[] = array(
			"name"  => __('Apple Touch Icons','truethemes_localize'),
			"std"   => __('Specify a custom icon to be displayed on a users Apple mobile device when they save your website to their home screen. <a href="http://iconifier.net/" target="_blank">Free online icon generator tool</a>','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('iPhone','truethemes_localize'),
			"desc" => __('57px x 57px','truethemes_localize'),
			"id"   => $shortname."_apple_iphone",
			"type" => "upload");
			
$options[] = array(
			"name" => __('iPhone (Retina)','truethemes_localize'),
			"desc" => __('114px x 114px','truethemes_localize'),
			"id"   => $shortname."_apple_iphone_114",
			"type" => "upload");
			
$options[] = array(
			"name" => __('iPad','truethemes_localize'),
			"desc" => __('72px x 72px','truethemes_localize'),
			"id"   => $shortname."_apple_ipad_72",
			"type" => "upload");
			
$options[] = array(
			"name" => __('iPad (Retina)','truethemes_localize'),
			"desc" => __('144px x 144px','truethemes_localize'),
			"id"   => $shortname."_apple_ipad_144",
			"type" => "upload");
			
//filter to allow developer to add new options to this section.
$options = apply_filters('theme_option_mobile',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Blog Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array( 
			"name" => __('Blog and Posts','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"	 => __('Blog Settings','truethemes_localize'),
			"std"	 => __('Global Settings for your website\'s Blog.','truethemes_localize'),
			"class"  => "heading-parent",
			"type"   => "info");
			
$options[] = array( 
			"name"    => __('Blog Page','truethemes_localize'),
			"desc"    => __('Select your website\'s blog page.','truethemes_localize'),
			"id"      => $shortname."_blogpage",
			"type"    => "select-advance",
			"options" => $of_pages);
			
$options[] = array(
			"name" => __('Title','truethemes_localize'),
			"desc" => __('Enter the Title to be displayed in the blog\'s utility bar.','truethemes_localize'),
			"id"   => $shortname."_blogtitle",
			"std"  => "Blog",
			"type" => "text");
			
$options[] = array(
			"name"    => __('Exclude Categories','truethemes_localize'),
			"desc"    => __('Select any categories that you\'d like to hide from the blog.','truethemes_localize'),
			"id"      => $shortname."_blogexcludetest",
			"type"    => "multicheck",
			"options" => $exclude_categories);
			
$options[] = array(
			"name"    => __('Image Frames','truethemes_localize'),
			"desc"    => __('Select an image frame style for featured images.','truethemes_localize'),
			"id"      => $shortname."_blog_image_frame",
			"std"     => "modern",
			"type"    => "images",
			"options" => array(
				'modern' => $image_url . 'image-frame-modern.png',
				'shadow' => $image_url . 'image-frame-shadow.png'
				));

$options[] = array(
			"name"  => __('Post Settings','truethemes_localize'),
			"std"   => __('A handful of powerful settings for your blog posts.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
				
$options[] = array(
			"name" => __('Post Content &lt;!--more --&gt;','truethemes_localize'),
			"desc" => __('This theme automatically adds a "Read More" button after 80 characters of text. Check this box to instead revert back to the Wordpress content() function requiring a  &lt;!--more --&gt; tag for content breaking.','truethemes_localize'),
			"id"   => $shortname."_tt_content_default",
			"std"  => "false",
			"type" => "checkbox");
				
$options[] = array(
			"name" => __('"Posted by" Information','truethemes_localize'),
			"desc" => __('Check this box to hide the "Posted by" information printed under each blog post title.','truethemes_localize'),
			"id"   => $shortname."_posted_by",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Post Date','truethemes_localize'),
			"desc" => __('Check this box to hide the post date on all blog posts.</em>','truethemes_localize'),
			"id"   => $shortname."_post_date",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array( 
            "name" => __('"Read More" - Button Label','truethemes_localize'),
			"desc" => __('Enter a custom label for the "read more" buttons.','truethemes_localize'),
			"id"   => $shortname."_blogbutton",
			"std"  => "Continue Reading &rarr;",
			"type" => "text");
				
$options[] = array(
            "name" => __('"Read More" - Button Color','truethemes_localize'),
			"desc" => __('Select a color for the "read more" buttons.','truethemes_localize'),
			"id"   => $shortname."_blogbutton_color",
			"std"  => "black",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
				'royalblue'     => $image_url . 'karma-royal-blue.png',
				'politicalblue' => $image_url . 'karma-political-blue.png',
				'coolblue'      => $image_url . 'karma-cool-blue.png',
				'skyblue'       => $image_url . 'karma-sky-blue.png',
				'vistablue'     => $image_url . 'karma-vista-blue.png',
				'black'           => $image_url . 'karma-dark.png',
				'tealgrey'      => $image_url . 'karma-teal-grey.png',
				'grey'           => $image_url . 'karma-grey.png',
				'bluegrey'      => $image_url . 'karma-blue-grey.png',
				'saffronblue'   => $image_url . 'karma-saffron-blue.png',
				'steelgreen'    => $image_url . 'karma-steel-green.png',
				'tufgreen'      => $image_url . 'karma-tuf-green.png',
				'silver'         => $image_url . 'karma-silver.png',
				'coffee'         => $image_url . 'karma-coffee.png',
				'autumn'         => $image_url . 'karma-autumn.png',
				'teal'           => $image_url . 'karma-teal.png',
				'alphagreen'    => $image_url . 'karma-alpha-green.png',
				'frenchgreen'   => $image_url . 'karma-french-green.png',
				'yogigreen'     => $image_url . 'karma-yogi-green.png',
				'forestgreen'   => $image_url . 'karma-forest-green.png',
				'limegreen'     => $image_url . 'karma-lime-green.png',
				'golden'         => $image_url . 'karma-golden.png',
				'orange'         => $image_url . 'karma-orange.png',
				'fire'           => $image_url . 'karma-fire.png',
				'buoyred'       => $image_url . 'karma-buoy-red.png',
				'cherry'         => $image_url . 'karma-cherry.png',
				'purple'         => $image_url . 'karma-purple.png',
				'pink'           => $image_url . 'karma-pink.png',
				'periwinkle'     => $image_url . 'karma-periwinkle.png',
				'violet'         => $image_url . 'karma-violet.png'	
				));
				
$options[] = array(
            "name" => __('"Read More" - Button Size','truethemes_localize'),
			"desc" => __('Select a size for the "read more" buttons.','truethemes_localize'),
			"id"   => $shortname."_blogbutton_size",
			"std"  => "Small",
			"type" => "select",
			"options" => array(
				'Small',
				'Medium',
				'Large',
				));
			
$options[] = array(
			"name" => __('About-the-Author','truethemes_localize'),
			"desc" => __('The author\'s bio is displayed at the end of each Single Blog post. <em>Un-check this box to disable this functionality.</em><br />Author bio can be set within the Wordpress Profile page. <a href="profile.php">Users > Your Profile</a>','truethemes_localize'),
			"id"   => $shortname."_blogauthor",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Related Posts','truethemes_localize'),
			"desc" => __('Un-check this box to disable related posts at the end of each blog post.','truethemes_localize'),
			"id"   => $shortname."_related_posts",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Related Posts - Title','truethemes_localize'),
			"desc" => __('Enter a title to be dislpayed above the related posts. (ie. "Related Posts").','truethemes_localize'),
			"id"   => $shortname."_related_posts_title",
			"std"  => "Related Posts",
			"type" => "text");
			
$options[] = array(
			"name" => __('Related Posts - Item Count','truethemes_localize'),
			"desc" => __('How many related posts would you like to display? (3-5 is recommended).','truethemes_localize'),
			"id"   => $shortname."_related_posts_count",
			"std"  => "5",
			"type" => "text");
			
$options[] = array(
			"name" => __('Post Comments','truethemes_localize'),
			"desc" => __('Un-check this box to completely disable comments on all blog posts.','truethemes_localize'),
			"id"   => $shortname."_post_comments",
			"std"  => "true",
			"type" => "checkbox");			
			
$options[] = array(
			"name" => __('Post Comments - Avatar','truethemes_localize'),
			"desc" => __('This theme uses a custom avatar image when users do not have a Gravatar.com account. <em>Un-check this box to disable this functionality and use WordPress avatars instead.</em>','truethemes_localize'),
			"id"   => $shortname."_default_avatar",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name"  => __('Social Sharing','truethemes_localize'),
			"std"   => __('Use the settings below to use custom font settings instead.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");	
			
$options[] = array(
					"name" => __('Drag-to-Share','truethemes_localize'),
					"desc" => __('An interactive "drag-to-share" button added to each blog post.','truethemes_localize'),
					"id"   => $shortname."_dragshare",
					"std"  => "true",
					"type" => "checkbox");
			
$options[] = array(
					"name" => __('Social Sharing Links','truethemes_localize'),
					"desc" => __('Font-Awesome vector sharing buttons for Twitter, Facebook and Google+.','truethemes_localize'),
					"id"   => $shortname."_blog_social_sharing",
					"std"  => "false",
					"type" => "checkbox");
						
			
//allow developer to add in new options to this section.			
$options = apply_filters('theme_option_blog_settings',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Color Scheme Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Color Scheme','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Color Scheme','truethemes_localize'),
			"std"   => __('Choose from 30 professionally-designed color schemes. Click one and done.','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
		
$options[] = array(
			"name"    => __('Primary Color Scheme','truethemes_localize'),
			"desc"    => __('Please select the primary color scheme for your website. (header and footer color scheme)','truethemes_localize'),
			"id"      => $shortname."_main_scheme",
			"std"     => "karma-saffron-blue",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
				'karma-royal-blue'     => $image_url . 'karma-royal-blue.png',
				'karma-political-blue' => $image_url . 'karma-political-blue.png',
				'karma-cool-blue'      => $image_url . 'karma-cool-blue.png',
				'karma-sky-blue'       => $image_url . 'karma-sky-blue.png',
				'karma-vista-blue'     => $image_url . 'karma-vista-blue.png',
				'karma-dark'           => $image_url . 'karma-dark.png',
				'karma-teal-grey'      => $image_url . 'karma-teal-grey.png',
				'karma-grey'           => $image_url . 'karma-grey.png',
				'karma-blue-grey'      => $image_url . 'karma-blue-grey.png',
				'karma-saffron-blue'   => $image_url . 'karma-saffron-blue.png',
				'karma-steel-green'    => $image_url . 'karma-steel-green.png',
				'karma-tuf-green'      => $image_url . 'karma-tuf-green.png',
				'karma-silver'         => $image_url . 'karma-silver.png',
				'karma-coffee'         => $image_url . 'karma-coffee.png',
				'karma-autumn'         => $image_url . 'karma-autumn.png',
				'karma-teal'           => $image_url . 'karma-teal.png',
				'karma-alpha-green'    => $image_url . 'karma-alpha-green.png',
				'karma-french-green'   => $image_url . 'karma-french-green.png',
				'karma-yogi-green'     => $image_url . 'karma-yogi-green.png',
				'karma-forest-green'   => $image_url . 'karma-forest-green.png',
				'karma-lime-green'     => $image_url . 'karma-lime-green.png',
				'karma-golden'         => $image_url . 'karma-golden.png',
				'karma-orange'         => $image_url . 'karma-orange.png',
				'karma-fire'           => $image_url . 'karma-fire.png',
				'karma-buoy-red'       => $image_url . 'karma-buoy-red.png',
				'karma-cherry'         => $image_url . 'karma-cherry.png',
				'karma-purple'         => $image_url . 'karma-purple.png',
				'karma-pink'           => $image_url . 'karma-pink.png',
				'karma-periwinkle'     => $image_url . 'karma-periwinkle.png',
				'karma-violet'         => $image_url . 'karma-violet.png'	
				));
				
$options[] = array(
			"name"    => __('Secondary Color Scheme','truethemes_localize'),
			"desc"    => __('Select a secondary color scheme only if you wish to override the default secondary color. (left nav, utility bar, etc)','truethemes_localize'),
			"id"      => $shortname."_secondary_scheme",
			"std"     => "default",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
				'default' => $image_url . 'none.png',
				'secondary-royal-blue'     => $image_url . 'karma-royal-blue.png',
				'secondary-political-blue' => $image_url . 'karma-political-blue.png',
				'secondary-cool-blue'      => $image_url . 'karma-cool-blue.png',
				'secondary-sky-blue'       => $image_url . 'karma-sky-blue.png',
				'secondary-vista-blue'     => $image_url . 'karma-vista-blue.png',
				'secondary-dark'           => $image_url . 'karma-dark.png',
				'secondary-teal-grey'      => $image_url . 'karma-teal-grey.png',
				'secondary-grey'           => $image_url . 'karma-grey.png',
				'secondary-blue-grey'      => $image_url . 'karma-blue-grey.png',
				'secondary-saffron-blue'   => $image_url . 'karma-saffron-blue.png',
				'secondary-steel-green'    => $image_url . 'karma-steel-green.png',
				'secondary-tuf-green'      => $image_url . 'karma-tuf-green.png',
				'secondary-silver'         => $image_url . 'karma-silver.png',
				'secondary-coffee'         => $image_url . 'karma-coffee.png',
				'secondary-autumn'         => $image_url . 'karma-autumn.png',
				'secondary-teal'           => $image_url . 'karma-teal.png',
				'secondary-alpha-green'    => $image_url . 'karma-alpha-green.png',
				'secondary-french-green'   => $image_url . 'karma-french-green.png',
				'secondary-yogi-green'     => $image_url . 'karma-yogi-green.png',
				'secondary-forest-green'   => $image_url . 'karma-forest-green.png',
				'secondary-lime-green'     => $image_url . 'karma-lime-green.png',
				'secondary-golden'         => $image_url . 'karma-golden.png',
				'secondary-orange'         => $image_url . 'karma-orange.png',
				'secondary-fire'           => $image_url . 'karma-fire.png',
				'secondary-buoy-red'       => $image_url . 'karma-buoy-red.png',
				'secondary-cherry'         => $image_url . 'karma-cherry.png',
				'secondary-purple'         => $image_url . 'karma-purple.png',
				'secondary-pink'           => $image_url . 'karma-pink.png',
				'secondary-periwinkle'     => $image_url . 'karma-periwinkle.png',
				'secondary-violet'         => $image_url . 'karma-violet.png'	
				));
				
$options[] = array(
			"name"  => __('Custom Color Scheme','truethemes_localize'),
			"std"   => __('Use the Settings below to create your own Custom Color Scheme. Please note that all settings below are only visible when a custom color scheme is activated.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Custom - Primary Color Scheme','truethemes_localize'),
			"desc" => __('Check this box to activate Custom Primary Website Color Scheme. <em>(header and footer color scheme)</em>','truethemes_localize'),
			"id"   => $shortname."_activate_custom_primary_color_scheme",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Custom - Secondary Color Scheme','truethemes_localize'),
			"desc" => __('Check this box to activate Custom Secondary Website Color Scheme.  <em>(link color, breadcrumb bar, etc)</em>','truethemes_localize'),
			"id"   => $shortname."_activate_custom_secondary_color_scheme",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name"  => __('Custom - Primary Color Scheme:','truethemes_localize'),
			"std"   => __('Specify a color scheme for the Header and Footer areas of your website.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Top Toolbar - Background Color','truethemes_localize'),
			"desc" => __('Specify a background color for the toolbar. The toolbar is the solid-colored bar at the top of the header.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_toolbar",
			"type" => "color");
			
$options[] = array(
			"name" => __('Header/Footer - Gradient Color - Light','truethemes_localize'),
			"desc" => __('Specify the lighter color of the custom gradient.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_gradient_light",
			"type" => "color");
			
$options[] = array(
			"name" => __('Header/Footer - Gradient Color - Dark','truethemes_localize'),
			"desc" => __('Specify the darker color of the custom gradient.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_gradient_dark",
			"type" => "color");
			
$options[] = array(
			"name" => __('Header/Footer - Top Border Color','truethemes_localize'),
			"desc" => __('The Header and Footer have a subtle 1px top border. This color should be slightly lighter than the color used for "Gradient Color - Light".','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_border_top",
			"type" => "color");
			
$options[] = array(
			"name" => __('Footer - Text Color','truethemes_localize'),
			"desc" => __('Specify the color of all text displayed within the Footer.<br />#DDDDDD works great color for most color schemes.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_footer_text",
			"type" => "color");
			
$options[] = array(
			"name" => __('Footer Bottom - Background Color','truethemes_localize'),
			"desc" => __('The footer-bottom is the the bottommost area that contains the footer menu and copyright information.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_footer_bottom",
			"type" => "color");
			
$options[] = array(
			"name" => __('Footer Bottom - Background Image','truethemes_localize'),
			"desc" => __('Upload','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_image_footer_bottom", 
			"type" => "upload");
			
$options[] = array(
			"name" => __('Dropdown Menu - Background Color','truethemes_localize'),
			"desc" => __('Specify the background color of the main menu dropdowns.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_menu_dropdown_bg",
			"type" => "color");
			
$options[] = array(
			"name" => __('Dropdown Menu - Link Hover Background Color','truethemes_localize'),
			"desc" => __('Specify the background color displayed behind links on hover.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_menu_dropdown_linkhover_bg",
			"type" => "color");
			
$options[] = array(
			"name"  => __('Internet Explorer 8','truethemes_localize'),
			"std"   => __('Internet Explorer 8 does not support RGBa so requires these additional settings:','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('IE8 - Top Toolbar - Text Color','truethemes_localize'),
			"desc" => __('Specify the color for all text within the Top Toolbar.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_ie8_toolbar_text",
			"type" => "color");
			
$options[] = array(
			"name" => __('IE8 - Main Menu - Navi Description Text','truethemes_localize'),
			"desc" => __('Specify the color for the main menu navi description text.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_primary_ie8_navi_text",
			"type" => "color");
			
$options[] = array(
			"name"  => __('Custom - Secondary Color Scheme:','truethemes_localize'),
			"std"   => __('Specify a custom color scheme for the Sub-nav, Utility bar, links and more.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Gradient Color - Light','truethemes_localize'),
			"desc" => __('Specify the lighter color of the custom gradient.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_secondary_gradient_light",
			"type" => "color");
			
$options[] = array(
			"name" => __('Gradient Color - Dark','truethemes_localize'),
			"desc" => __('Specify the darker color of the custom gradient.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_secondary_gradient_dark",
			"type" => "color");
			
$options[] = array(
			"name" => __('Horizontal/Gallery Nav - Active Link Background Color','truethemes_localize'),
			"desc" => __('Specify a background color for the active state of Horizontal/Gallery Navigation links.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_secondary_active_horz_link",
			"type" => "color");
			
$options[] = array(
			"name" => __('Link Color','truethemes_localize'),
			"desc" => __('Specify a color for your website\'s links.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_secondary_link_color",
			"type" => "color");
			
$options[] = array(
			"name" => __('Image - Utility Bar - Top','truethemes_localize'),
			"desc" => __('980x6','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_image_top",
			"type" => "upload");
			
$options[] = array(
			"name" => __('Image - Utility Bar - Middle','truethemes_localize'),
			"desc" => __('980x2','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_image_middle", 
			"type" => "upload");
			
$options[] = array(
			"name" => __('Image - Utility Bar - Bottom','truethemes_localize'),
			"desc" => __('980x6','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_image_bottom", 
			"type" => "upload");
			
$options[] = array(
			"name" => __('Image - jQuery Banner','truethemes_localize'),
			"desc" => __('940x283','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_image_jquery_banner", 
			"type" => "upload");
			
$options[] = array(
			"name" => __('Image - Right/Left Nav - Active Link','truethemes_localize'),
			"desc" => __('Upload','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_image_nav_state", 
			"type" => "upload");
			
$options[] = array(
			"name"  => __('Internet Explorer 8','truethemes_localize'),
			"std"   => __('Internet Explorer 8 does not support RGBa so requires these additional color settings:','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('IE8 - Footer - Link Color','truethemes_localize'),
			"desc" => __('Specify the color for all links within the Footer.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_secondary_ie8_footer_links",
			"type" => "color");
			
$options[] = array(
			"name" => __('IE8 - Footer - Heading Border','truethemes_localize'),
			"desc" => __('Specify the color for the bottom border on all Footer headings.','truethemes_localize'),
			"id"   => $shortname."_custom_scheme_secondary_ie8_footer_headings",
			"type" => "color");
			
//filter to allow developer to add new options to this section.		
$options = apply_filters('theme_option_styling_settings',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Fonts and Links Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Fonts','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"	 => __('Font Kits','truethemes_localize'),
			"std"	 => __('Groups of pre-designed Google Fonts with pixel-perfect settings. Click one and done.','truethemes_localize'),
			"class"  => "heading-parent",
			"type"   => "info");
			
$options[] = array(
			"name" => __('Modern Font Kit','truethemes_localize'),
			"desc" => __('The Modern Font Kit contains clean and modern sans-serif fonts perfect for every type of website.<br /><em>Lato + Open Sans</em>.','truethemes_localize'),
			"id"   => $shortname."_font_kit_modern",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Serif Font Kit','truethemes_localize'),
			"desc" => __('The Serif Font Kit contains a gorgeous combination of serif and sans-serif fonts for a sophisticated design.<br /><em>PT Serif + Source Sans Pro</em>.','truethemes_localize'),
			"id"   => $shortname."_font_kit_serif",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Organic Font Kit','truethemes_localize'),
			"desc" => __('The Organic Font Kit contains clean and rounded sans-serif fonts for a soft and inviting design.<br /><em>Varela Round + Open Sans</em>.','truethemes_localize'),
			"id"   => $shortname."_font_kit_organic",
			"std"  => "false",
			"type" => "checkbox");
					
$options[] = array(
			"name"  => __('Custom Font Settings','truethemes_localize'),
			"std"   => __('Use the settings below to use custom font settings instead.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");		
			
$options[] = array(
		    "name" => __('Google Web Fonts','truethemes_localize'),
			"desc" => __('Select a font face to be used for your website\'s headings.<br>Font names (from left to right):<br>- (none)<br>- Droid Sans<br>- Cabin<br>- Cantarell<br>- Cuprum<br>- Oswald<br>- Neuton<br>- Oritron<br>- Arvo<br>- Kreon<br>- Indie Flower<br>- Josefin Sans','truethemes_localize'),
			"id"      => $shortname."_google_font",
			"std"     => "nofont",
			"type"    => "images",
			"options" => array(
				'nofont'       => $image_url . 'none.png',
				'Droid+Sans'   => $image_url . '1-droid-sans.png',
				'Cabin'        => $image_url . '2-cabin.png',
				'Cantarell'    => $image_url . '3-cantarell.png',
				'Cuprum'       => $image_url . '4-cuprum.png',
				'Oswald'       => $image_url . '5-oswald.png',
				'Neuton'       => $image_url . '6-neuton.png',
				'Orbitron'     => $image_url . '7-orbitron.png',
				'Arvo'         => $image_url . '8-arvo.png',
				'Kreon'        => $image_url . '9-kreon.png',
				'Indie+Flower' => $image_url . '10-indie-flower.png',
				'Josefin Sans' => $image_url . '11-josefin-sans.png'
				));			
				
$options[] = array(
			"name" => __('Custom Google Web Font','truethemes_localize'),
			"desc" => __('Enter a custom font name If you prefer to use a font that\'s not listed above.<br>Here is the complete list of available <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts</a>.','truethemes_localize'),
			"id" => $shortname."_custom_google_font",
			"type" => "text");
			
$options[] = array(
			"name" =>  __('Font Color &rarr; Custom Logo','truethemes_localize'),
			"desc" => __('Select a font color for the custom logo.','truethemes_localize'),
			"id"   => $shortname."_custom_logo_font_color",
			"type" => "color");
					
$options[] = array(
			"name" =>  __('Font Color &rarr; Main Menu','truethemes_localize'),
			"desc" => __('Select a font color for the main menu items.','truethemes_localize'),
			"id"   => $shortname."_main_menu_font_color",
			"type" => "color");
					
$options[] = array( 
			"name" =>  __('Font Color &rarr; Main Content','truethemes_localize'),
			"desc" => __('Select a font color for the main content area.','truethemes_localize'),
			"id"   => $shortname."_main_content_font_color",
			"type" => "color");

$options[] = array(
			"name" =>  __('Font Color &rarr; Footer Content','truethemes_localize'),
			"desc" => __('Select a font color for the footer content area.','truethemes_localize'),
			"id"   => $shortname."_footer_content_font_color",
			"type" => "color");
					
$options[] = array(
			"name" =>  __('Font Color &rarr; Links','truethemes_localize'),
			"desc" => __('Select a font color for links.','truethemes_localize'),
			"id"   => $shortname."_link_font_color",
			"type" => "color");
					
$options[] = array(
			"name" =>  __('Font Color &rarr; Link:Hover','truethemes_localize'),
			"desc" => __('Select a font color for links on hover.','truethemes_localize'),
			"id"   => $shortname."_link_hover_font_color",
			"type" => "color");
					
$options[] = array(
			"name" =>  __('Font Color &rarr; Side Navigation','truethemes_localize'),
			"desc" => __('Select a font color for the side navigation items.','truethemes_localize'),
			"id"   => $shortname."_side_menu_font_color",
			"type" => "color");
					
$options[] = array(
			"name" =>  __('Font Color &rarr; H1 Headings','truethemes_localize'),
			"desc" => __('Select a font color for all &lt;h1&gt; headings.','truethemes_localize'),
			"id"   => $shortname."_h1_font_color",
			"type" => "color");
					
$options[] = array(
			"name" =>  __('Font Color &rarr; H2 Headings','truethemes_localize'),
			"desc" => __('Select a font color for all &lt;h2&gt; headings.','truethemes_localize'),
			"id"   => $shortname."_h2_font_color",
			"type" => "color");
					
$options[] = array(
			"name" =>  __('Font Color &rarr; H3 Headings','truethemes_localize'),
			"desc" => __('Select a font color for all &lt;h3&gt; headings.','truethemes_localize'),
			"id"   => $shortname."_h3_font_color",
			"type" => "color");					

$options[] = array(
			"name" =>  __('Font Color &rarr; H4 Headings','truethemes_localize'),
			"desc" => __('Select a font color for all &lt;h4&gt; headings.','truethemes_localize'),
			"id"   => $shortname."_h4_font_color",
			"type" => "color");

$options[] = array(
			"name" =>  __('Font Color &rarr; H5 Headings','truethemes_localize'),
			"desc" => __('Select a font color for all &lt;h5&gt; headings.','truethemes_localize'),
			"id"   => $shortname."_h5_font_color",
			"type" => "color");


$options[] = array(
			"name" =>  __('Font Color &rarr; H6 Headings','truethemes_localize'),
			"desc" => __('Select a font color for all &lt;h6&gt; headings.','truethemes_localize'),
			"id"   => $shortname."_h6_font_color",
			"type" => "color");					
				
//start of font-size selectors.

//auto generate font size array from 9px to 50px.
//change numbers to increase or decrease sizes.
$font_sizes = array();
for($size = 9; $size < 51; $size ++){
$font_sizes[] = $size."px";
}

array_unshift($font_sizes,"--select--");										
					
$options[] = array( "name" => __('Font Size &rarr; Custom Logo','truethemes_localize'),
			"desc" => __('Select a font size for the custom logo.','truethemes_localize'),
			"id" => $shortname."_custom_logo_font_size",
			"std" => "--select--",
			"type" => "select",
			"options" => $font_sizes);	
			
$options[] = array( "name" => __('Font Size &rarr; Main Menu','truethemes_localize'),
			"desc" => __('Select a font size for the main menu items.','truethemes_localize'),
			"id" => $shortname."_main_menu_font_size",
			"std" => "--select--",
			"type" => "select",
			"options" => $font_sizes);
			

$options[] = array( "name" => __('Font Size &rarr; Main Content','truethemes_localize'),
			"desc" => __('Select a font size for the main content area.','truethemes_localize'),
			"id" => $shortname."_main_content_font_size",
			"std" => "--select--",
			"type" => "select",
			"options" => $font_sizes);
			
$options[] = array( "name" => __('Font Size &rarr; Side Navigation','truethemes_localize'),
			"desc" => __('Select a font size for side navigation items. headings.','truethemes_localize'),
			"id" => $shortname."_side_menu_font_size",
			"std" => "--select--",
			"type" => "select",
			"options" => $font_sizes);

$options[] = array( "name" =>  __('Font Size &rarr; H1 Headings','truethemes_localize'),
					"desc" => __('Select a font size for all &lt;h1&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h1_font_size",
					"std" => "--select--",
					"type" => "select",
					"options" => $font_sizes);				

$options[] = array( "name" =>  __('Font Size &rarr; H2 Headings','truethemes_localize'),
					"desc" => __('Select a font size for all &lt;h2&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h2_font_size",
					"std" => "--select--",
					"type" => "select",
					"options" => $font_sizes);	
					
$options[] = array( "name" =>  __('Font Size &rarr; H3 Headings','truethemes_localize'),
					"desc" => __('Select a font size for all &lt;h3&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h3_font_size",
					"std" => "--select--",
					"type" => "select",
					"options" => $font_sizes);			

$options[] = array( "name" =>  __('Font Size &rarr; H4 Headings','truethemes_localize'),
					"desc" => __('Select a font size for all &lt;h4&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h4_font_size",
					"std" => "--select--",
					"type" => "select",
					"options" => $font_sizes);	

$options[] = array( "name" =>  __('Font Size &rarr; H5 Headings','truethemes_localize'),
					"desc" => __('Select a font size for all &lt;h5&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h5_font_size",
					"std" => "--select--",
					"type" => "select",
					"options" => $font_sizes);	


$options[] = array( "name" =>  __('Font Size &rarr; H6 Headings','truethemes_localize'),
					"desc" => __('Select a font size for all &lt;h6&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h6_font_size",
					"std" => "--select--",
					"type" => "select",
					"options" => $font_sizes);
					
$options[] = array( "name" =>  __('Font Size &rarr; Footer Content','truethemes_localize'),
					"desc" => __('Select a font size for the footer content area. headings.','truethemes_localize'),
					"id" => $shortname."_footer_content_font_size",
					"std" => "--select--",
					"type" => "select",
					"options" => $font_sizes);

//array of all custom font types.
$font_types = array(
				'nofont',
				'Arial',
				'Arial Black',
				'Courier New',
				'Georgia',
				'Helvetica',
				'Impact',
				'Lucida Console',
				'Lucida Sans Unicode',
				'Tahoma',
				'Times New Roman',
				'Verdana',
				'MS Sans Serif',
				'Droid Sans',
				'Cabin',
				'Cantarell',
				'Cuprum',
				'Oswald',
				'Neuton',
				'Orbitron',
				'Arvo',
				'Kreon',
				'Indie Flower',
				'Josefin Sans'
				);										
					
$options[] = array( "name" => __('Font Face &rarr; Custom Logo Text','truethemes_localize'),
			"desc" => __('Select a font face for your custom logo text.','truethemes_localize'),
			"id" => $shortname."_custom_logo_font",
			"std" => "nofont",
			"type" => "select",
			"options" => $font_types);											


$options[] = array( "name" => __('Font Face &rarr; Main Content','truethemes_localize'),
			"desc" => __('Select a font face for the main content area.','truethemes_localize'),
			"id" => $shortname."_main_content_font",
			"std" => "nofont",
			"type" => "select",
			"options" => $font_types);

$options[] = array( "name" => __('Font Face &rarr; Main Menu','truethemes_localize'),
			"desc" => __('Select a font face for the main menu items.','truethemes_localize'),
			"id" => $shortname."_main_navigation_font",
			"std" => "nofont",
			"type" => "select",
			"options" => $font_types);

$options[] = array( "name" => __('Font Face &rarr; Side Navigation','truethemes_localize'),
			"desc" => __('Select a font face for the side navigation items.','truethemes_localize'),
			"id" => $shortname."_sidebar_menu_font",
			"std" => "nofont",
			"type" => "select",
			"options" => $font_types);

$options[] = array( "name" =>  __('Font Face &rarr; H1 Headings','truethemes_localize'),
					"desc" => __('Select a font face for all &lt;h1&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h1_font",
					"std" => "nofont",
					"type" => "select",
					"options" => $font_types);			

$options[] = array( "name" =>  __('Font Face &rarr; H2 Headings','truethemes_localize'),
					"desc" => __('Select a font face for all &lt;h2&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h2_font",
					"std" => "nofont",
					"type" => "select",
					"options" => $font_types);

$options[] = array( "name" =>  __('Font Face &rarr; H3 Headings','truethemes_localize'),
					"desc" => __('Select a font face for all &lt;h3&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h3_font",
					"std" => "nofont",
					"type" => "select",
					"options" => $font_types);

$options[] = array( "name" =>  __('Font Face &rarr; H4 Headings','truethemes_localize'),
					"desc" => __('Select a font face for all &lt;h4&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h4_font",
					"std" => "nofont",
					"type" => "select",
					"options" => $font_types);

$options[] = array( "name" =>  __('Font Face &rarr; H5 Headings','truethemes_localize'),
					"desc" => __('Select a font face for all &lt;h5&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h5_font",
					"std" => "nofont",
					"type" => "select",
					"options" => $font_types);
				
$options[] = array( "name" =>  __('Font Face &rarr; H6 Headings','truethemes_localize'),
					"desc" => __('Select a font face for all &lt;h6&gt; headings.','truethemes_localize'),
					"id" => $shortname."_h6_font",
					"std" => "nofont",
					"type" => "select",
					"options" => $font_types);	
				
$options[] = array( "name" =>  __('Font Face &rarr; Footer Content','truethemes_localize'),
					"desc" => __('Select a font face for the footer content area.','truethemes_localize'),
					"id" => $shortname."_footer_content_font",
					"std" => "nofont",
					"type" => "select",
					"options" => $font_types);
			
			
//allow developer to add in new options to this section.			
$options = apply_filters('theme_option_typography_settings',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Logo Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Logo','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"	 => __('Logo ','truethemes_localize'),
			"std"	 => __('A handful of powerful settings for your website\'s logo.','truethemes_localize'),
			"class"  => "heading-parent",
			"type"   => "info");
			
		
$options[] = array(
			"name"    => __('Logo Position','truethemes_localize'),
			"desc"    => __('Select the position for your company\'s logo. (left, center, right)','truethemes_localize'),
			"id"      => $shortname."_true_logo",
			"std"     => "tt-logo-left",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
			    'tt-logo-left' 	    => $image_url . 'tt-logo-left.png',
				'tt-logo-center' 	=> $image_url . 'tt-logo-center.png',
				'tt-logo-right' 	=> $image_url . 'tt-logo-right.png'
			    ));
			
$options[] = array(
			"name"  => __('Upload your Logo','truethemes_localize'),
			"desc"  => __('Recommended dimensions: 154 x 57','truethemes_localize'),
			"id"    => $shortname."_sitelogo",
			"type"  => "upload");
			
$options[] = array(
			"name" => __('Website Logo - ALT Text','truethemes_localize'),
			"desc" => __('Enter custom ALT Text for your website\'s logo. If left blank the Site Title specified within <a href="'.admin_url( 'options-general.php' ).'">Settings > General</a> will be used.' ,'truethemes_localize'),
			"id"   => $shortname."_logo_alt",
			"type" => "text");
			
$options[] = array(
			"name"  => __('Website Logo - Retina Version','truethemes_localize'),
			"desc"  => __('Use this section to upload a retina version of your logo.<br /><strong>Important notes:</strong><br />The dimensions of the retina logo need to be exactly twice the size of the original logo.','truethemes_localize'),
			"id"    => $shortname."_sitelogo_retina",
			"type"  => "upload");
			
$options[] = array(
			"name" => __('Website Logo - Width','truethemes_localize'),
			"desc" => __('Enter the width of your logo if you\'ve uploaded a Retina logo above. <em>(Please Note: this is the width of the original non-retina logo)</em><br /><strong>Example input:</strong> 154px','truethemes_localize'),
			"id"   => $shortname."_sitelogo_width",
			"type" => "text");
			
$options[] = array(
			"name" => __('Website Logo - Height','truethemes_localize'),
			"desc" => __('Enter the height of your logo if you\'ve uploaded a Retina logo above. <em>(Please Note: this is the height of the original non-retina logo)</em><br /><strong>Example input:</strong> 57px','truethemes_localize'),
			"id"   => $shortname."_sitelogo_height",
			"type" => "text");
			
$options[] = array(
			"name" => __('Website Favicon','truethemes_localize'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>','truethemes_localize'),
			"id"   => $shortname."_favicon",
			"type" => "upload");
			
$options[] = array(
			"name"	 => __('Logo Builder','truethemes_localize'),
			"std"	 => __('Don\'t have a company logo? Use the Builder tool below to create one. (or simply ignore this section)','truethemes_localize'),
			"class"  => "heading-parent heading-parent-alt",
			"type"   => "info");
			
$options[] = array(
			"name" => __('Logo Builder - Icon','truethemes_localize'),
			"desc" => __('Select a logo icon.','truethemes_localize'),
			"id"      => $shortname."_logo_icon",
			"std"     => "nologo",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
				'custom-logo-1.png' => $image_url . 'logo-1.png',
				'custom-logo-2.png' => $image_url . 'logo-2.png',
				'custom-logo-3.png' => $image_url . 'logo-3.png',
				'custom-logo-4.png' => $image_url . 'logo-4.png',
				'custom-logo-5.png' => $image_url . 'logo-5.png',
				'custom-logo-6.png' => $image_url . 'logo-6.png',
				'custom-logo-7.png' => $image_url . 'logo-7.png',
				'custom-logo-8.png' => $image_url . 'logo-8.png',
				'custom-logo-9.png' => $image_url . 'logo-9.png'
				));
				
$options[] = array(
			"name" => __('Logo Builder - Text','truethemes_localize'),
			"desc" => __('Enter logo text. <em>(Please Note: When text is entered into this field it will disable the logo image upload above. Simply remove text from this field to re-enable logo upload.)</em>','truethemes_localize'),
			"id"   => $shortname."_logo_text",
			"type" => "text");
			
			
$options[] = array(
			"name"	 => __('Wordpress','truethemes_localize'),
			"std"	 => __('Upload a logo to be displayed on the Worpress login screen','truethemes_localize'),
			"class"  => "heading-parent heading-parent-alt",
			"type"   => "info");
			
$options[] = array(
			"name" => __('Wordpress - Upload Logo','truethemes_localize'),
			"desc" => __('Recommended dimensions: 285 x 80','truethemes_localize'),
			"id"   => $shortname."_loginlogo",
			"type" => "upload");
			
//allows developer to add in new options to this section.				
$options = apply_filters('theme_option_logo',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Header Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Header and Menu','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Header Settings','truethemes_localize'),
			"std"   => __('Customize all items within the Header area of your website. (Top Toolbar, Header, Main Menu)','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Fixed Header and Menu Bar','truethemes_localize'),
			"desc" => __('Check this box to enable a fixed header and menu bar.','truethemes_localize'),
			"id"   => $shortname."_fix_header_and_menubar",
			"std"  => "false",
			"type" => "checkbox");			
			
$options[] = array(
			"name" => __('Toolbar','truethemes_localize'),
			"desc" => __('Un-check this box to disable the colored toolbar section at the top of the website above the header, logo and main menu area.','truethemes_localize'),
			"id"   => $shortname."_toolbar",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Toolbar - Left Side','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Toolbar - Left Side.','truethemes_localize'),
			"id"   => $shortname."_toolbar_left",
			"std"  => "true",
			"type" => "checkbox");

$options[] = array(
			"name" => __('Toolbar - Right Side','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Toolbar - Right Side.','truethemes_localize'),
			"id"   => $shortname."_toolbar_right",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Header - Transparent Overlay Image','truethemes_localize'),
			"desc" => __('Select a transparent overlay image for the header area of your website.','truethemes_localize'),
			"id"   => $shortname."_header_transparent_overlay",
			"std"  => "overlay-rays.png",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
			'overlay-none' 	            => $image_url . 'overlay-none.png',
			'overlay-rays.png' 	        => $image_url . 'overlay-rays.png',
			'overlay-abstract.png' 	    => $image_url . 'overlay-abstract.png',
			'overlay-bokeh.png' 	    => $image_url . 'overlay-bokeh.png',
			'overlay-diagonal.png' 	    => $image_url . 'overlay-diagonal.png',
			'overlay-halftone.png' 	    => $image_url . 'overlay-halftone.png',
			'overlay-paisley.png' 	    => $image_url . 'overlay-paisley.png',
			'overlay-stars.png' 	    => $image_url . 'overlay-stars.png'
			));
			
$options[] = array(
			"name" => __('Header - Transparent Overlay Image - Upload','truethemes_localize'),
			"desc" => __('Use this section if you prefer to upload a custom transparent overlay image for the header area of your website.','truethemes_localize'),
			"id"   => $shortname."_header_transparent_overlay_upload", 
			"type" => "upload");
			
$options[] = array(
			"name" => __('Header - Height Adjust','truethemes_localize'),
			"desc" => __('Adjust the height of the heading by entering a custom value for it\'s padding.<br />The default value is: <strong>35px</strong>','truethemes_localize'),
			"id"   => $shortname."_header_height_adjust", 
			"type" => "text");
			
$options[] = array(
			"name"  => __('Menu Settings','truethemes_localize'),
			"std"   => __('Customize your website\'s main menu.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Main Menu - Dropdowns','truethemes_localize'),
			"desc" => __('Check this box to disable the dropdowns in the main menu.','truethemes_localize'),
			"id"   => $shortname."_dropdown",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Main Menu - Item Descriptions','truethemes_localize'),
			"desc" => __('Check this box to disable the short descriptive text displayed below each main menu item.','truethemes_localize'),
			"id"   => $shortname."_nav_description",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name"  => __('UberMenu Settings','truethemes_localize'),
			"std"   => __('Use the options below to incorporate the UberMenu Plugin into your website.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('UberMenu Plugin','truethemes_localize'),
			"desc" => __('This theme is fully compatible with the <a href="codecanyon.net/item/ubermenu-wordpress-mega-menu-plugin/154703?ref=TrueThemes">UberMenu Plugin</a>. Check this box to enable UberMenu and activate the necessary functions for seamless rendering.<br /><em>Please note: the UberMenu Plugin is not included with this theme. You will need to purchase and install the <a href="codecanyon.net/item/ubermenu-wordpress-mega-menu-plugin/154703?ref=TrueThemes">UberMenu Plugin</a> before activating this setting.</em>','truethemes_localize'),
			"id"   => $shortname."_ubermenu",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('UberMenu - Default Karma Styling','truethemes_localize'),
			"desc" => __('Check this box to enable Karma\'s default menu styling within the UberMenu Plugin. Please do not check this box if you wish to use one of UberMenus\'s pre-loaded Style Presets. <em>More details outlined in the <a href="http://vimeopro.com/truethemes/karma-4" target="_blank">Karma UberMenu Training Video</a></em>','truethemes_localize'),
			"id"   => $shortname."_ubermenu_karma_styling",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('UberMenu - Karma Mobile Menu','truethemes_localize'),
			"desc" => __('Check this box to enable Karma\'s default Mobile Menu. This will override UberMenu\'s Mobile Settings. Please do not check this box if you prefer to user UberMenu
			\'s Mobile menu.','truethemes_localize'),
			"id"   => $shortname."_ubermenu_karma_mobile_menu",
			"std"  => "false",
			"type" => "checkbox");
			
//allows developer to add in new options to this section.				
$options = apply_filters('theme_option_interface_settings',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Content Area Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Content Area','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Content Area','truethemes_localize'),
			"std"   => __('Customize the content area of your website. This is the main area that spans between the header and footer.','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array(
			"name"    => __('Content Area - Background Color','truethemes_localize'),
			"desc"    => __('Choose a custom background color for the content area of your website.','truethemes_localize'),
			"id"      => $shortname."_div_main_style",
			"std"     => "content-style-default",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
				'content-style-default' => $image_url . 'content-area-default.png',
				'content-style-tan'     => $image_url . 'content-area-tan.png',
				'content-style-white'   => $image_url . 'content-area-white.png',
				'content-style-grey'    => $image_url . 'content-area-grey.png',
				'content-style-steel'   => $image_url . 'content-area-steel.png'
				));
				
$options[] = array(
			"name" => __('Content Area - Disable Gradient','truethemes_localize'),
			"desc" => __('Check this box to disable the subtle gradients at the top and bottom of the content area. Disabling this gradient will give your website a more flat design style.','truethemes_localize'),
			"id"   => $shortname."_true_content_gradient",
			"std"  => "false",
			"type" => "checkbox");
				
$options[] = array(
			"name" => __('Content Area - Custom Background Color','truethemes_localize'),
			"desc" => __('Use this color picker to specify a custom background color for the main content area of your website.','truethemes_localize'),
			"id"   => $shortname."_div_main_custom_color",
			"type" => "color");
			
$options[] = array(
			"name" => __('Content Area - Separator Lines - Dark','truethemes_localize'),
			"desc" => __('If you\'ve used the color picker to specify a custom background color then you\'ll need to specify a color for the separator lines.<br />Separator lines are the 2 pixel borders between sidebar widgets, sidebar/content areas, etc.<br />Specify the Dark separator line by choosing a color just slightly darker than your custom content area background color.','truethemes_localize'),
			"id"   => $shortname."_content_separator_dark",
			"type" => "color");
			
$options[] = array(
			"name" => __('Content Area - Separator Lines - Light','truethemes_localize'),
			"desc" => __('Set the Light separator line by choosing a color just slightly lighter than the custom background color.','truethemes_localize'),
			"id"   => $shortname."_content_separator_light",
			"type" => "color");
			
$options[] = array(
			"name" => __('Utility Bar','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Utility Bar. This is the colored panel displayed within each page that contains the Page Title, Breadcrumbs and Search box.','truethemes_localize'),
			"id"   => $shortname."_tools_panel",
			"std"  => "true",
			"type" => "checkbox");	
			
$options[] = array(
			"name" => __('Utility Bar - Breadcrumbs','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Breadcrumbs.','truethemes_localize'),
			"id"   => $shortname."_crumbs",
			"std"  => "true",
			"type" => "checkbox");	
			
$options[] = array(
			"name" => __('Utility Bar - Search box','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Search box.</em>','truethemes_localize'),
			"id" => $shortname."_searchbar",
			"std" => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Utility Bar - Search box Text','truethemes_localize'),
			"desc" => __('Customize the text that is displayed in the search box.','truethemes_localize'),
			"id"   => $shortname."_searchbartext",
			"std"  => "Search",
			"type" => "text");

$options[] = array(
			"name" => __('Utility Bar - Breadcrumbs (Home Link)','truethemes_localize'),
			"desc" => __('Customize the text used for the homepage link in the breadcrumbs.','truethemes_localize'),
			"id"   => $shortname."_breadcrumbs_home_text",
			"std"  => "Home",
			"type" => "text");
			
$options[] = array(
			"name" => __('Google Map - Contact Page','truethemes_localize'),
			"desc" => __('Input the &lt;iframe&gt; map code if using the Google Map Contact Page.<br />This code can be obtained from <a href="https://maps.google.com/">https://maps.google.com/</a>','truethemes_localize'),
			"id"   => $shortname."_google_map_input",
			"std"  => "",
			"type" => "textarea");
				
//allows developer to add in new options to this section.				
$options = apply_filters('theme_option_interface_settings',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Footer Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Footer','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Footer Settings','truethemes_localize'),
			"std"   => __('A handful of powerful settings for the footer area of your website.','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array(
			"name"    => __('Footer - Transparent Overlay Image','truethemes_localize'),
			"desc"    => __('Select a transparent overlay image for the footer area of your website.','truethemes_localize'),
			"id"      => $shortname."_footer_transparent_overlay",
			"std"     => "overlay-none",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
			'overlay-none' 	            => $image_url . 'overlay-none.png',
			'overlay-rays.png' 	        => $image_url . 'overlay-rays.png',
			'overlay-abstract.png' 	    => $image_url . 'overlay-abstract.png',
			'overlay-bokeh.png' 	    => $image_url . 'overlay-bokeh.png',
			'overlay-diagonal.png' 	    => $image_url . 'overlay-diagonal.png',
			'overlay-halftone.png' 	    => $image_url . 'overlay-halftone.png',
			'overlay-paisley.png' 	    => $image_url . 'overlay-paisley.png',
			'overlay-stars.png' 	    => $image_url . 'overlay-stars.png'
			));
			
$options[] = array(
			"name" => __('Footer - Transparent Overlay Image - Upload','truethemes_localize'),
			"desc" => __('Use this section if you prefer to upload a custom transparent overlay image for the footer area of your website.','truethemes_localize'),
			"id"   => $shortname."_footer_transparent_overlay_upload", 
			"type" => "upload");
			
$options[] = array(
			"name"    => __('Footer - Design Style','truethemes_localize'),
			"desc"    => __('1. footer + copyright<br />2. footer only<br />3. copyright only','truethemes_localize'),
			"id"      => $shortname."_footer_layout",
			"std"     => "full_bottom",
			"type"    => "images",
			"options" => array(
				'full_bottom' => $image_url . 'footer-layout-1.png',
				'full'        => $image_url . 'footer-layout-2.png',
				'bottom'      => $image_url . 'footer-layout-3.png'
				));	
			
$options[] = array(
			"name"    => __('Footer - Columns','truethemes_localize'),
			"desc"    => __('Select the number of columns to be displayed in the footer.','truethemes_localize'),
			"id"      => $shortname."_footer_columns",
			"std"     => "3",
			"type"    => "select",
			"options" => $footer_columns);
			
$options[] = array(
			"name" => __('Footer Callout','truethemes_localize'),
			"desc" => __('Check this box to enable the Footer Callout section.','truethemes_localize'),
			"id"   => $shortname."_footer_callout_main",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Footer Callout - Background Color','truethemes_localize'),
			"desc" => __('Use this color picker to specify a custom background color for the footer callout area.','truethemes_localize'),
			"id"   => $shortname."_footer_callout_main_bg",
			"type" => "color");

$options[] = array(
			"name" => __('Footer Callout - Content','truethemes_localize'),
			"desc" => __('Enter the content to be displayed within the Footer Callout Section.','truethemes_localize'),
			"id"   => $shortname."_footer_callout_content",
			"std"  => "<p class=\"footer-callout-heading\">Heading goes here</p>
			<p class=\"footer-callout-text\">Text goes here</p>",
			"type" => "textarea");
			
$options[] = array(
			"name" => __('Footer Callout - Link URL','truethemes_localize'),
			"desc" => __('Enter a URL to link the Footer Callout Section.<br /><em><strong>Example:</strong> http://www.google.com</em>','truethemes_localize'),
			"id"   => $shortname."_footer_callout_link",
			"type" => "text");
			
$options[] = array(
			"name" => __('Footer Callout - Link Hover - Background Color','truethemes_localize'),
			"desc" => __('Use this color picker to specify a custom background color for the footer callout link (when link is hovered).','truethemes_localize'),
			"id"   => $shortname."_footer_callout_link_hover_bg",
			"type" => "color");
			
$options[] = array(
			"name" => __('Footer - Scroll-to-top Link','truethemes_localize'),
			"desc" => __('Un-check this box to disable the scroll-to-top link.','truethemes_localize'),
			"id"   => $shortname."_scrolltoplink",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('Footer - Scroll-to-top Text','truethemes_localize'),
			"desc" => __('Customize the text used for the scroll-to-top link.','truethemes_localize'),
			"id"   => $shortname."_scrolltoplinktext",
			"std"  => "top",
			"type" => "text");
			
$options[] = array(
			"name"  => __('Footer Copyright','truethemes_localize'),
			"std"   => __('Define the Footer Copyright Text within <a href="'.admin_url( 'customize.php' ).'">Appearance > Customize</a>','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Footer Copyright','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Footer Copyright section.','truethemes_localize'),
			"id"   => $shortname."_footer_copyright",
			"std"  => "true",
			"type" => "checkbox");
			
//allows developer to add in new options to this section.				
$options = apply_filters('theme_option_footer_settings',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Sliders Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Sliders','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Slider Settings','truethemes_localize'),
			"std"   => __('A handful of custom settings for all jQuery Sliders within your website.','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array( 
			"name" => __('Pause on Hover','truethemes_localize'),
			"desc" => __('Check this box to pause the slider when a user hovers over with their mouse.','truethemes_localize'),
			"id"   => $shortname."_karma_jquery_pause_hover", //using same ID to maintain settings > karma 3.1
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array( 
			"name" => __('Randomize Slides','truethemes_localize'),
			"desc" => __('Check this box to randomize the order of the slides.','truethemes_localize'),
			"id"   => $shortname."_karma_jquery_randomize",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array( 
			"name" => __('Next/Previous Arrows','truethemes_localize'),
			"desc" => __('Check this box to display next/previous arrows.','truethemes_localize'),
			"id"   => $shortname."_karma_jquery_directionNav",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array( 
			"name" => __('Animation Effect','truethemes_localize'),
			"desc" => __('Select an animation effect.','truethemes_localize'),
			"id"   => $shortname."_karma_jquery_animation_effect",
			"std"  => "fade",
			"type" => "select",
			"options" => array(
				'fade',
				'slide'
				));
			
$options[] = array(
			"name" => __('Display Time','truethemes_localize'),
			"desc" => __('Enter the amount of time to display each slide before changing, in milliseconds.','truethemes_localize'),
			"id"   => $shortname."_karma_jquery_timeout", //using same ID to maintain settings > karma 3.1
			"std"  => "8000",
			"type" => "text");
			
$options[] = array(
			"name" => __('Animation Speed','truethemes_localize'),
			"desc" => __('Enter the speed of the animations, in milliseconds.','truethemes_localize'),
			"id"   => $shortname."_karma_jquery_animationSpeed",
			"std"  => "600",
			"type" => "text");
			
$options[] = array(
			"name"  => __('jQuery2 Slider','truethemes_localize'),
			"std"   => __('Custom settings for the jQuery2 Slider.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name"    => __('jQuery2 Slider - Background Color','truethemes_localize'),
			"desc"    => __('Choose a background color for the jQuery2 Slider. (or specify custom background color below)','truethemes_localize'),
			"id"      => $shortname."_jquery2_slider_bg",
			"std"     => "#E7E9E6",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
				'#E7E9E6' => $image_url . 'jquery2-bg-1.png',
				'#F0EFE9' => $image_url . 'jquery2-bg-2.png',
				'#FFF'    => $image_url . 'jquery2-bg-3.png',
				'#E6EAF1' => $image_url . 'jquery2-bg-4.png',
				'#EEE'    => $image_url . 'jquery2-bg-5.png'
				));
				
$options[] = array(
			"name" => __('jQuery2 Slider - Custom Background Color','truethemes_localize'),
			"desc" => __('Specify a custom background color for the jQuery2 Slider.','truethemes_localize'),
			"id"   => $shortname."_jquery2_slider_bg_custom",
			"type" => "color");
			
$options[] = array(
			"name"  => __('jQuery3 Slider','truethemes_localize'),
			"std"   => __('Custom settings for the jQuery3 Slider.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name"    => __('jQuery3 Slider - Transparent Overlay Image','truethemes_localize'),
			"desc"    => __('Select a transparent overlay image for the jQuery3 Slider.','truethemes_localize'),
			"id"   	  => $shortname."_jquery3_transparent_overlay",
			"std" 	  => "",
			"class"   => "tt-option-alt-layout",
			"type"    => "images",
			"options" => array(
			'overlay-none' 	            => $image_url . 'overlay-none.png',
			'overlay-abstract.png' 	    => $image_url . 'overlay-abstract.png',
			'overlay-bokeh.png' 	    => $image_url . 'overlay-bokeh.png',
			'overlay-diagonal.png' 	    => $image_url . 'overlay-diagonal.png',
			'overlay-halftone.png' 	    => $image_url . 'overlay-halftone.png',
			'overlay-paisley.png' 	    => $image_url . 'overlay-paisley.png',
			'overlay-stars.png' 	    => $image_url . 'overlay-stars.png'
			));
			
$options[] = array(
			"name" => __('jQuery3 Slider - Custom Background Color','truethemes_localize'),
			"desc" => __('Specify a custom background color for the jQuery3 Slider.','truethemes_localize'),
			"id"   => $shortname."_jquery3_slider_bg_custom",
			"type" => "color");
			
$options[] = array(
			"name"  => __('Testimonial Slider','truethemes_localize'),
			"std"   => __('Custom settings for the Testimonial Slider.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
			//@since 4.0 - removed "enable testimonial slider" - now included in custom-main.js
			
$options[] = array( 
			"name" => __('Pause on Hover','truethemes_localize'),
			"desc" => __('Check this box to pause the slider when a user hovers over with their mouse.','truethemes_localize'),
			"id"   => $shortname."_testimonial_pause_hover",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array( 
			"name" => __('Randomize Slides','truethemes_localize'),
			"desc" => __('Check this box to randomize the order of the slides.','truethemes_localize'),
			"id"   => $shortname."_testimonial_randomize",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array( 
			"name" => __('Next/Previous Arrows','truethemes_localize'),
			"desc" => __('Check this box to display next/previous arrows.','truethemes_localize'),
			"id"   => $shortname."_testimonial_directionNav",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array( 
			"name" => __('Animation Effect','truethemes_localize'),
			"desc" => __('Select an animation effect.','truethemes_localize'),
			"id"   => $shortname."_testimonial_animation_effect",
			"std"  => "fade",
			"type" => "select",
			"options" => array(
				'fade',
				'slide'
				));
			
$options[] = array(
			"name" => __('Display Time','truethemes_localize'),
			"desc" => __('Enter the amount of time to display each slide before changing, in milliseconds.','truethemes_localize'),
			"id"   => $shortname."_testimonial_timeout",
			"std"  => "8000",
			"type" => "text");
			
$options[] = array(
			"name" => __('Animation Speed','truethemes_localize'),
			"desc" => __('Enter the speed of the animations, in milliseconds.','truethemes_localize'),
			"id"   => $shortname."_testimonial_animationSpeed",
			"std"  => "600",
			"type" => "text");
			
$options[] = array(
			"name"  => __('Karma 3.1 Settings','truethemes_localize'),
			"std"   => __('The settings below have been deprecated since Karma 3.1. These settings are no longer needed and can safely be ignored.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name"    => __('jQuery Slider Post Category','truethemes_localize'),
			"desc"    => __('Select the category that will be used for generating the jQuery slides.','truethemes_localize'),
			"id"      => $shortname."_jcycle_category",
			"std"     => "Select a category:",
			"type"    => "select",
			"options" => $of_categories);
			
$options[] = array(
			"name" => __('JQuery Slider Pause Settings','truethemes_localize'),
			"desc" => __('Check this box if you would like the jQuery slider to pause when the user hovers over a slide.','truethemes_localize'),
			"id"   => $shortname."_jcycle_pause_hover",
			"std"  => "false",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('jQuery Homepage Slider Time','truethemes_localize'),
			"desc" => __('Enter the desired amount of time you would like to display each slide. (milliseconds)','truethemes_localize'),
			"id"   => $shortname."_jcycle_timeout",
			"std"  => "8000",
			"type" => "text");			
			
$options[] = array(
			"name" => __('3D CU3ER - Slider ID Number','truethemes_localize'),
			"desc" => __('Enter the ID number of the 3D slider you would like to embed on the "Homepage :: 3D" page template.<br><em>Not sure where to find the slider ID number? <a href="http://themes.5-squared.com/support/cu3er-instructions.html" target="_blank">View these visual instructions.</a></em>','truethemes_localize'),
			"id"   => $shortname."_cu3er_slider_id",
			"std"  => "1",
			"type" => "text");
		
//allow developer to add in new options to this section.
$options = apply_filters('theme_option_javascript_settings',$options);



/*-----------------------------------------------------------------------------------*/
/* Create Plugins Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Plugins and Forms','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Plugin Settings','truethemes_localize'),
			"std"   => __('Easily install a variety of included plugins.','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Included Plugins','truethemes_localize'),
			"std" => __('This theme comes packaged with a variety of awesome plugins. Review and install these plugins from within the <a href="'.admin_url( 'themes.php?page=install-required-plugins' ).'">Install Plugins</a> section of your WP Dashboard.','truethemes_localize'),
			"type" => "info");
			
$options[] = array(
			"name"  => __('Form Builder Settings','truethemes_localize'),
			"std"   => __('A handful of powerful settings for the included Form Builder.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Form Builder','truethemes_localize'),
			"desc" => __('A powerful form builder is included in this theme by default. <em>Un-check this box to disable the form builder.</em>','truethemes_localize'),
			"id"   => $shortname."_formbuilder",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('"Required Text"','truethemes_localize'),
			"desc" => __('Customize the text that will be displayed next to required fields.','truethemes_localize'),
			"id"   => $shortname."_contact_required",
			"std"  => "(required)",
			"type" => "text");
			
$options[] = array(
			"name" => __('Success Message','truethemes_localize'),
			"desc" => __('Customize the success message that will be displayed after a user submits the form.','truethemes_localize'),
			"id"   => $shortname."_contact_successmsg",
			"std"  => "Thank you for messaging us. We will get back to you as soon as possible. Cheers!",
			"type" => "textarea");
			
$options[] = array(
			"name" => __('Submit Button - Text','truethemes_localize'),
			"desc" => __('Customize the text to be used for the form\'s Submit Button','truethemes_localize'),
			"id"   => $shortname."_submit_button_text",
			"std"  => "SUBMIT",
			"type" => "text");	
			
$options[] = array(
			"name" => __('reCAPTCHA: Public Key','truethemes_localize'),
			"desc" => __('Enter your reCAPTCHA Public Key.<br>
			You can obtain your reCAPTCHA keys at: <a href="http://www.google.com/recaptcha" target="_blank">google.com/recaptcha</a><br><em>Simply leave this field blank if you won\'t be using this functionality.</em>','truethemes_localize'),
			"id"   => $shortname."_publickey",
			"type" => "text");			
			
$options[] = array(
			"name" => __('reCAPTCHA: Private Key','truethemes_localize'),
			"desc" => __('Enter your reCAPTCHA Private Key.<br>
			You can obtain your reCAPTCHA keys at: <a href="http://www.google.com/recaptcha" target="_blank">google.com/recaptcha</a><br><em>Simply leave this field blank if you won\'t be using this functionality.</em>','truethemes_localize'),
			"id"   => $shortname."_privatekey",
			"type" => "text");		

//added since version 2.6
$options[] = array(
			"name"    => __('reCAPTCHA Theme - Select a theme','truethemes_localize'),
			"desc"    => __('Select a reCAPTCHA theme.</em>','truethemes_localize'),
			"id"      => $shortname."_recaptcha_theme",
			"std"     => "default_theme",
			"type"    => "images",
			"options" => array(
				'default_theme' => $image_url . 'recaptcha-red.jpg',
				'white_theme'   => $image_url . 'recaptcha-white.jpg',
				'black_theme'   => $image_url . 'recaptcha-black.jpg',
				'clean_theme'   => $image_url . 'recaptcha-clean.jpg',
				));

$options[] = array(
			"name" => __('reCAPTCHA Theme - Customization','truethemes_localize'),
			"desc" => __('<strong>(For Advance User Only)</strong><br/><br/>This setting overwrites the above reCAPTCHA theme selection. <br/><br/>You can customize the look and feel of reCAPTCHA, by entering your custom javascript code in the box provided.<br />Please read <a href="http://code.google.com/intl/pt-PT/apis/recaptcha/docs/customization.html" target="_blank">reCAPTCHA developer documentation</a> for details.<br/><br/><u><strong>Important Notes:</strong></u><br/>Please change the javascript codes from google documentation to use <strong>double quotes</strong> rather than single quotes for all javascript variables.','truethemes_localize'),
			"id"   => $shortname."_recaptcha_custom",
			"type" => "textarea");
			
//filter to allow developer to add new options to this section.
$options = apply_filters('theme_option_plugins',$options);
$options = apply_filters('theme_option_forms_settings',$options);		

				


/*-----------------------------------------------------------------------------------*/
/* Create Utility Pages Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Utility Pages','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
			"name"  => __('Utility Pages','truethemes_localize'),
			"std"   => __('Customize the 404 Error Page, Search Results and Sitemap Pages.','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array(
			"name" => __('404 Error - Page Title','truethemes_localize'),
			"desc" => __('Set the page title to be displayed in the breadcrumb area of the 404 Error Page.','truethemes_localize'),
			"id"   => $shortname."_404title",
			"std"  => "Page not Found",
			"type" => "text");
			
$options[] = array(
			"name" => __('404 Error - Page Content','truethemes_localize'),
			"desc" => __('Set the page content to be displayed within the 404 Error Page.','truethemes_localize'),
			"id"   => $shortname."_404message",
			"std"  => "Our Apologies, but the page you are looking for could not be found. Here are some links that you might find useful:
			<ul>
			<li><a href=\"http://www.\">Home</a></li>
			<li><a href=\"http://www.\">Sitemap</a></li>
			<li><a href=\"http://www.\">Contact Us</a></li>
			</ul>",
			"type" => "textarea");
			
$options[] = array(
			"name"  => __('Search Results','truethemes_localize'),
			"std"   => __('Custom settings for the search results page.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Search Results - Page Title','truethemes_localize'),
			"desc" => __('Set the page title to be displayed in the breadcrumb area of the Search Results Page.','truethemes_localize'),
			"id"   => $shortname."_results_title",
			"std"  => "Search Results",
			"type" => "text");
			
$options[] = array(
			"name" => __('Search Results - Fallback Message','truethemes_localize'),
			"desc" => __('Set the message to be displayed when a search comes back with no results.','truethemes_localize'),
			"id"   => $shortname."_results_fallback",
			"std"  => "<p>Our Apologies, but your search did not return any results. Please try using a different search term.</p>",
			"type" => "textarea");
			
$options[] = array(
			"name"  => __('Sitemap Settings','truethemes_localize'),
			"std"   => __('The following settings are only required when using the Sitemap-2 Page Template.','truethemes_localize'),
			"class" => "heading-parent heading-parent-alt",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Sitemap - Column One Title','truethemes_localize'),
			"desc" => __('This title is displayed above the list of pages in the first column.','truethemes_localize'),
			"id"   => $shortname."_sitemap2_column1",
			"std"  => "Pages",
			"type" => "text");
			
$options[] = array(
			"name" => __('Sitemap - Column Two Title','truethemes_localize'),
			"desc" => __('This title is displayed above the list of posts in the second column.','truethemes_localize'),
			"id"   => $shortname."_sitemap2_column2",
			"std"  => "Posts",
			"type" => "text");
			
$options[] = array(
			"name" => __('Sitemap - Column Three Content','truethemes_localize'),
			"desc" => __('This content is displayed in the third column.','truethemes_localize'),
			"id"   => $shortname."_sitemap2_column3",
			"std"  => "<h3>Contact</h3>
    <p><strong>Email:</strong> <a href=\"mailto:you@yoursite.com\">you@yoursite.com</a><br />
	<strong>Mobile:</strong> 444-555-6666</p>",
			"type" => "textarea");
			
//allow developer to add in new options to this section.				
$options = apply_filters('theme_option_utility_settings',$options);
			
			

/*-----------------------------------------------------------------------------------*/
/* Create WooCommerce Array */
/*-----------------------------------------------------------------------------------*/		
//check if woocommence is activated before showing this menu item
if (class_exists('woocommerce')):

$options[] = array(
			"name" => __('WooCommerce','truethemes_localize'),
			"type" => "heading");
			
$options[] = array(
            "name" => __('WooCommerce - Page Layout','truethemes_localize'),
			"desc" => __('Choose a Page Layout for all WooCommerce pages.','truethemes_localize'),
			"id"   => $shortname."_woocommerce_layout",
			"std"  => "Right Sidebar",
			"type" => "select",
			"options" => array(
			    'Right Sidebar',
				'Left Sidebar',
				'Full Width',
				));
			
$options[] = array(
			"name" => __('WooCommerce - Utility Bar','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Utility Bar on all WooCommerce pages. This is the colored panel that contains the Page Title, Breadcrumbs and Search box.','truethemes_localize'),
			"id"   => $shortname."_woocommerce_tools_panel",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('WooCommerce - Utility Bar - Breadcrumbs','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Breadcrumbs.','truethemes_localize'),
			"id"   => $shortname."_woocommerce_breadcrumbs",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('WooCommerce - Utility Bar - Search Box','truethemes_localize'),
			"desc" => __('Un-check this box to disable the Search box.','truethemes_localize'),
			"id"   => $shortname."_woocommerce_searchbar",
			"std"  => "true",
			"type" => "checkbox");
			
$options[] = array(
			"name" => __('WooCommerce - Custom Title','truethemes_localize'),
			"desc" => __('This title will be displayed in the utility panel of all WooCommerce pages.','truethemes_localize'),
			"id"   => $shortname."_woocommerce_title",
			"std"  => "Shop",
			"type" => "text");
			
			
//allow developer to add in new options to this section.		
$options = apply_filters('theme_option_woocommerce_settings',$options);

endif; //end checking for woocommence.



/*-----------------------------------------------------------------------------------*/
/* Create Twitter oAuth Array */
/*-----------------------------------------------------------------------------------*/	
$options[] = array(
			"name" => __('Twitter oAuth','truethemes_localize'),
			"type" => "heading");

$options[] = array(
			"name"  => __('Twitter oAuth','truethemes_localize'),
			"std"   => __('As of June 11, 2013 Twitter has shutdown their public API and the latest tweets functionality now requires the authentication credentials listed below. <strong>Need Assistance?</strong> <a href="https://support.truethemes.net/?knowledgebase=twitter-feed-down-latest-tweets-not-displaying" target="_blank">View this HelpDesk article &rarr;</a>','truethemes_localize'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Consumer Key','truethemes_localize'),
			"desc" => __('Enter your Twitter application\'s Consumer Key.','truethemes_localize'),
			"id"   => "twitter_api_consumer_key",
			"type" => "text");	
			
$options[] = array(
			"name" => __('Consumer Secret','truethemes_localize'),
			"desc" => __('Enter your Twitter application\'s Consumer Secret.','truethemes_localize'),
			"id"   => "twitter_api_consumer_secret",
			"type" => "text");	
			
$options[] = array(
			"name" => __('Access Token','truethemes_localize'),
			"desc" => __('Enter your Twitter application\'s Access Token.','truethemes_localize'),
			"id"   => "twitter_api_access_token",
			"type" => "text");	
									
$options[] = array(
			"name" => __('Access Token Secret','truethemes_localize'),
			"desc" => __('Enter your Twitter application\'s Access Token Secret.','truethemes_localize'),
			"id"   => "twitter_api_access_token_secret",
			"type" => "text");
			
$options[] = array( 
			"name"    => __('Cache Timing','truethemes_localize'),
			"desc"    => __('Latest Tweets need to be cached in order to comply with Twitter API Call Limits.<br />Please select your desired cache timing interval.<br />(new tweets will be refreshed at the selected timing interval)','truethemes_localize'),
			"id"      => "twitter_cache_timing",
			"type"    => "select-advance",
			"options" => array(1800=>'30 minutes',3600=>'1 hour',7200=>'2 Hours',10800=>'3 hours'));
			
$options[] = array( 
			"name"    => __('Cache Temporary Disable','truethemes_localize'),
			"desc"    => __('Use this option to temporarily turn off the cache during configuration so that your changes will be reflected immediately. Remember to turn the cache back after you\'ve confirmed tweets are displaying nicely.','truethemes_localize'),
			"id"      => "twitter_cache_status",
			"type"    => "select",
			"options" => array('enable'=>'Turn on Cache','disable'=>'Turn off Cache'));	
			
//filter to allow developer to add new options to this section.
$options = apply_filters('theme_option_twitter_oauth',$options);	

update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>