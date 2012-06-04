<?php

if ( !function_exists( 'optionsframework_init' ) ) {

	/*-----------------------------------------------------------------------------------*/
	/* Options Framework Theme
	/*-----------------------------------------------------------------------------------*/

	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */

	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('stylesheet_directory') . '/admin/');
	}

	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>

<?php
}

/* 
 * Turns off the default options panel from Twenty Eleven
 */
 
add_action('after_setup_theme','remove_twentyeleven_options', 100);

function remove_twentyeleven_options() {
	remove_action( 'admin_menu', 'twentyeleven_theme_options_add_page' );
}


/* 
 * This is an example showing how to do some advanced jQuery selection.
 * This one shows/hides different inputs based on the data-attr value.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_advanced_jquery');

function optionsframework_advanced_jquery() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	var check = jQuery('input[type=checkbox]');
	var radio = jQuery('input[type=radio]');
	var dataElements = jQuery('[data-attr]');
	var dataAttr = dataElements.data('attr');
	var $dataAttr = '#'+dataAttr;

	//Cycles through the page finding the radio and checkbox elements, 
	//retrieves their data-attr value, then hides the elements with the id of 
	//that value.
	dataElements.each(function(){
		var $this = jQuery(this);
		var dataAttr = '#'+$this.data('attr');
		var $dataAttr = jQuery(dataAttr);

		$dataAttr.stop().hide();	

		if ($this.is(':checked')){
			$dataAttr.stop().show();

			if($this.is(radio)){
				$this.addClass('selected');
				
			}
		}

	});

	//For checkboxes, toggles the display of the element it's selected to hide. 
	//For Radio buttons, finds the closest element with class .selected, grabs 
	//its data-attr, hides that element, then shows the element it's selected.	
	dataElements.click(function(){
		var $this = jQuery(this);
		var dataAttr = '#'+$this.data('attr');
		var $dataAttr = jQuery(dataAttr);

		if ($this.is(check)){
			$dataAttr.slideToggle();
		}
		else if($this.is(radio)){
			var selected = $this.siblings('.selected');	
			var itemToHide = jQuery('#'+selected.data('attr'));
			itemToHide.stop().hide();
			$dataAttr.stop().show();
			selected.removeClass('selected');
			$this.addClass('selected');
		}
	});

});
</script>
<?php }
