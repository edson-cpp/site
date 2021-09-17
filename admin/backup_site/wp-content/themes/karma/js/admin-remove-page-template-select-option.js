//This script is only enqueued into WordPress admin page editor, if Karma 4.0 is activated from Site Option.
//this script removes a list of old homepage and old portfolio template names from WordPress page editor Page Attributes metabox, Template select dropdown.
//add or remove any template file name from the list below to show or hide page template from dropdown.
    jQuery(document).ready(function(){
    	jQuery("select[name='page_template'] option[value='template-homepage-3D.php']").remove();
    	jQuery("select[name='page_template'] option[value='template-homepage-full-width.php']").remove();
    	jQuery("select[name='page_template'] option[value='template-homepage-jquery.php']").remove();
    	jQuery("select[name='page_template'] option[value='template-homepage-jquery-2.php']").remove();
     	jQuery("select[name='page_template'] option[value='template-portfolio-1-column.php']").remove();
    	jQuery("select[name='page_template'] option[value='template-portfolio-1-column-portrait.php']").remove();
    	jQuery("select[name='page_template'] option[value='template-portfolio-2-columns.php']").remove();   
    	jQuery("select[name='page_template'] option[value='template-portfolio-3-columns.php']").remove();     	
    	jQuery("select[name='page_template'] option[value='template-portfolio-3-columns-portrait.php']").remove(); 
    	jQuery("select[name='page_template'] option[value='template-portfolio-3D.php']").remove();     	
    	jQuery("select[name='page_template'] option[value='template-portfolio-4-columns.php']").remove();  
		
		//hide old page metabox on Karma 4.0 
		jQuery(".cmb_id_truethemes_nonfilter_heading").css('display','none');
		jQuery(".cmb_id__multiple_portfolio_cat_id").css('display','none');
		jQuery(".cmb_id__sc_port_count_value").css('display','none');  	       	    	   		
    });