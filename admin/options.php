<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	$ds_col = 'ds_home_column_';
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';

	$options = array();
		
	$options[] = array( 	
		'name' => 'General Settings',
		'type' => 'heading'
		);


	$options[] = array(
		"name" => "Logo",
		"desc" => "Paste the URL to your logo, or upload it here.",
		"id" => "ds_logo",
		"std" => get_template_directory_uri()."/assets/img/logo.png",
		"type" => "upload",
		);

	$options[] = array(
		"name" => "Theme Color",
		"desc" => "",
		"id" => "ds_theme_color",
		"std" => "#37DAC1",
		"type" => "color",
		);

					
	$options[] = array(
		"name" => "Favicon with .ico extension",
		"desc" => "Paste the URL to your favicon with the .ico extension, or upload it here.",
		"id" => "ds_favicon_ico",
		"std" => "",
		"type" => "upload",
		);

	$options[] = array(
		"name" => "Favicon with .png extension",
		"desc" => "Paste the URL to your favicon with the .png extension, or upload it here.",
		"id" => "ds_favicon_png",
		"std" => "",
		"type" => "upload",
		);
					
	$options[] = array(
		"name" => "404 error message",
		"desc" => "Enter a message to display on your 404 (page not found) error pages.",
		"id" => "ds_404",
		"std" => "Apologies, but the page you requested could not be found. Perhaps searching will help.",
		"type" => "textarea",
		);

	$options[] = array(
		"name" => "Footer copyright text",
		"desc" => "Enter the text to be used in the footer copyright region",
		"id" => "ds_copyright",
		"std" => "Copyright 2012 - ".get_bloginfo('name'),
		"type" => "text",
		);
					

	$options[] = array(
		'name' => 'Home Page Options',
		'type' => 'heading'
		);


	$options[] = array(
		"name" => "Headline",
		"desc" => "The headline you wish to display.",
		"id" => "ds_headline",				
		"std" => "Web design\rWeb Development\rGraphic Design",
		"type" => "textarea",
		);
					
	$options[] = array(
		"name" => "Description",
		"desc" => "Write out whatever you'd like to say about yourself on the homepage.",
		"id" => "ds_site_description",				
		"std" => "",
		"type" => "textarea",
		);

	$options[] = array(
		"name" => "See more info link",
		"desc" => "Select which page you would like to point people to for the link above the image slider.",
		"id" => "ds_info_link",				
		"type" => "select",
		"options" => $options_pages,
		);

	$options[] = array(
		"name" => "See more info link text",
		"desc" => "Input the text you would like to see displayed for the link.",
		"id" => "ds_info_text",				
		"std" => "see more info",
		"type" => "text",
		);

	$options[] = array(
		"name" => "See more services link",
		"desc" => "Select which page you would like to point people to for the link above the columns.",
		"id" => "ds_services_link",				
		"type" => "select",
		"options" => $options_pages,
		);

	$options[] = array(
		"name" => "See more services link text",
		"desc" => "Input the text you would like to see displayed for the link.",
		"id" => "ds_services_text",				
		"std" => "see more services",
		"type" => "text",
		);

	$options[] = array(
		"name" => "See more works link",
		"desc" => "Select which page you would like to point people to for the link above the work thumbnails.",
		"id" => "ds_works_link",				
		"type" => "select",
		"options" => $options_pages,
		);

	$options[] = array(
		"name" => "See more services link text",
		"desc" => "Input the text you would like to see displayed for the link.",
		"id" => "ds_works_text",				
		"std" => "see more works",
		"type" => "text",
		);

	$options[] = array(
		"name" => "Display Services?",
		"desc" => "Would you like to display a section with up to 4 columns? Check if so.",
		"id" => "ds_display_services",				
		"std" => "1",
		"type" => "checkbox",
		);
					
	$options[] = array(
		"name" => "Choose Columns to Display",
		"desc" => "Select which columns you'd like to display.",
		"id" => 'ds_display_columns',				
		"std" => array("1" => "1", "2" => "1", "3" => "1", "4" => "1", ),
		"type" => "multicheck",
		"options" => array("1" => "Column 1", "2" => "Column 2", "3" => "Column 3", "4" => "Column 4", ),
		"data" => array("1" => "section-ds_home_column_1_headline, #section-ds_home_column_1_text", "2" => "section-ds_home_column_2_headline, #section-ds_home_column_2_text", "3" => "section-ds_home_column_3_headline, #section-ds_home_column_3_text", "4" => "section-ds_home_column_4_headline, #section-ds_home_column_4_text", ),
		);

	$options[] = array(
		"name" => "Column 1",
		"desc" => "Headline for the first column on the Home page.",
		"id" => $ds_col."1_headline",				
		"std" => "Web Design",
		"type" => "text",
		);
		
	$options[] = array(
		"type" => "textarea",
		"name" => "Column 1 Description",
		"id" => $ds_col."1_text",				
		"desc" => "Why not use this space to describe your services?",
		"std" => "" 
		);

	$options[] = array(
		"type" => "text",
		"name" => "Column 2",
		"id" => $ds_col."2_headline",				
		"desc" => "Headline for the second column on the Home page.",
		"std" => "Web Development" 
		);
					
	$options[] = array(
		"type" => "textarea",
		"name" => "Column 2 Description",
		"id" => $ds_col."2_text",				
		"desc" => "Why not use this space to describe your services?",
		"std" => "" 
		);

	$options[] = array(
		"type" => "text",
		"name" => "Column 3",
		"id" => $ds_col."3_headline",				
		"desc" => "Headline for the third column on the Home page.",
		"std" => "Graphic Design" 
		);
					
	$options[] = array(
		"type" => "textarea",
		"name" => "Column 3 Description",
		"id" => $ds_col."3_text",				
		"desc" => "Why not use this space to describe your services?",
		"std" => "" 
		);

	$options[] = array(
		"type" => "text",
		"name" => "Column 4",
		"id" => $ds_col."4_headline",				
		"desc" => "Headline for the fourth column on the Home page.",
		"std" => "Video Production" 
		);
					
	$options[] = array(
		"type" => "textarea",
		"name" => "Column 4 Description",
		"id" => $ds_col."4_text",				
		"desc" => "Why not use this space to describe your services?",
		"std" => "" 
		);

	$options[] = array( 
		'name' => 'Code Integration',
		'type' => 'heading'
		);

	$options[] = array(
		"name" => "Add these",
		"desc" => "Choose whether to display the code below in the given locations. You can uncheck the box and let the code remain in the boxes below to preserve it.",
		"id" => "ds_code_integration",
		"std" => array("js_head" => "1", "js_foot" => "1", "css" => "1"),
		"type" => "multicheck",
		"options" => array( "js_head" => "Add JavaScript to &lt;head&gt;", "js_foot" => "Add JavaScript to &lt;footer&gt;", "css" => "Add custom CSS"),					
		);

	$options[] = array(
		"name" => "Header Javascript",
		"desc" => "Enter any Javascript you may want for the header. You MUST enter &lt;script&gt; tags",
		"id" => "ds_header_js",
		"std" => "",
		"type" => "textarea",
		);
					
	$options[] = array(
		"name" => "Footer Javascript",
		"desc" => "Enter any Javascript you may want for the footer. You MUST enter &lt;script&gt; tags",
		"id" => "ds_footer_js",
		"std" => "",
		"type" => "textarea",
		);
					
	$options[] = array(
		"name" => "Custom CSS",
		"desc" => "Enter any custom CSS you want. You MUST NOT enter &lt;style&gt; tags",
		"id" => "ds_custom_css",
		"std" => "",
		"type" => "textarea",
		);

	$options[] = array(
		'name' => 'Contact Options',
		'type' => 'heading'
		);

	$options[] = array(
		"name" => "Your email ID",
		"desc" => "Enter your email ID, for use in the contact form widgets",
		"id" => "ds_email",
		"std" => get_option('admin_email'),
		"type" => "text",
		);

	$options[] = array(
		"name" => "Paste your Twitter URL here",
		"desc" => "",
		"id" => "ds_twitter",
		"std" => '',
		"type" => "text",
		 );

	$options[] = array(
		"name" => "Paste your Facebook URL here",
		"desc" => "",
		"id" => "ds_facebook",
		"std" => '',
		"type" => "text",
		 );

	$options[] = array(
		"name" => "Paste your Google+ URL here",
		"desc" => "",
		"id" => "ds_google_plus",
		"std" => '',
		"type" => "text",
		 );

	$options[] = array(
		"name" => "Address",
		"desc" => "Your physical address.",
		"id" => "ds_address",
		"std" => "",
		"type" => "textarea",
		);

	$options[] = array(
		"name" => "Phone Number",
		"desc" => "Your number, if you so choose.",
		"id" => "ds_phone",
		"std" => "",
		"type" => "text",
		 );

	$options[] = array(
		"name" => "Fax Number",
		"desc" => "Your fax number, if you have one.",
		"id" => "ds_fax",
		"std" => "",
		"type" => "text",
		 );
					
	$options[] = array(
		"name" => "Operating Hours",
		"desc" => "Enter the hours that you're in your office.",
		"id" => "ds_operating_hours",
		"std" => "Monday to Friday\r09h00 to 17h00 ",
		"type" => "textarea",
		);

	$options[] = array(
		"name" => "Thank You text",
		"desc" => "What you would like to say when an email is successfully sent.",
		"id" => "ds_thank_you",
		"std" => "Your email was successfully sent. I will be in touch soon.",
		"type" => "text",
		 );

	$options[] = array(
		"name" => "Error text",
		"desc" => "What you would like to say when there is an error sending an email.",
		"id" => "ds_error",
		"std" => "There was an error submitting the form.",
		"type" => "text",
		 );

	$options[] = array(
		"name" => "Google Map",
		"desc" => "Paste in the Google Maps embed code here. Set custom width and height to 222px and 258px. For more information, visit <a href='http://support.google.com/maps/bin/answer.py?hl=en&answer=72644' target='_blank'>Google Support</a>.",
		"id" => "ds_google_map",
		"std" => "",
		"type" => "textarea",
		 );
	return $options;
}
