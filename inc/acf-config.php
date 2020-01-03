<?php	
/* ====================================================
** Create Options Page
====================================================== */

	if( function_exists('acf_add_options_page') ) {			
		
		//Adds Theme Options
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Options',
			'menu_title'	=> 'Theme Options',
			'parent_slug'	=> 'themes.php',
		));
	}