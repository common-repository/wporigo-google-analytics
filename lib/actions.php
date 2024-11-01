<?php
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPOrigo GA actions
 * @package      WPOrigo Google Analytics
 * @author       Elod Horvath
 * @copyright    2014-... Elod Horvath
 * @since        1.0
*/



/**
 * Add page to admin dashboard
 */
function wporigo_ga_add_page() {

	add_menu_page(
			__( 'WPOrigo GA', 'wporigo_ga' ), 
			__( 'WPOrigo GA', 'wporigo_ga' ), 
			'manage_options',  
			'wporigo_ga_options',
			'wporigo_ga_create_page'
		);

}
add_action( 'admin_menu', 'wporigo_ga_add_page' );	


/**
 * Options page callback
 */
function wporigo_ga_create_page() {

	?>
		<div class="wrap wporigo-ga-page">
			<div id="icon-plugins" class="icon32"></div>
			<h2><?php _e( 'WPOrigo Google Analytics' , 'wporigo' ) ?></h2> 

			<form method="post" action="options.php">
			
				<?php 					 
					settings_fields( 'wporigo_ga_options' );   
					do_settings_sections( 'wporigo_ga_options' );

					submit_button(); 
				?>


			</form>			

		</div>

	<?php

}


/**
 * Register and add settings
 */
function wporigo_ga_page_init() {

	/**
	 * Register Options		
	 */
	register_setting(
		'wporigo_ga_options', // Options group
		'wporigo_ga_options', // Options name
		'wporigo_ga_sanitize' // Sanitize
	);		

	// Add Section
	add_settings_section(
		'wporigo_ga_options_section', // ID
		__( 'WPOrigo GA Options', 'wporigo_ga' ), // Title
		'', // Callback
		'wporigo_ga_options' // Page
	);  

	// Add field to the Section
	add_settings_field(
		'wporigo_ga_code', // ID
		__( 'Your Google Analytics Code', 'wporigo_ga' ), // Title 
		'wporigo_ga_code_cb', // Callback
		'wporigo_ga_options', // Page
		'wporigo_ga_options_section' // Section           
	); 

}
add_action( 'admin_init', 'wporigo_ga_page_init' );


/**
 * Sanitize section fields
 */
function wporigo_ga_sanitize( $input ) {

	$new_input = array();

	if( isset( $input['wporigo_ga_code'] ) )
		$new_input['wporigo_ga_code'] = $input['wporigo_ga_code'];

	return $new_input;

}


/**
 * Callback Section Fields
 */
function wporigo_ga_code_cb() {

	$options = get_option( 'wporigo_ga_options' );

	printf(
		'<textarea id="wporigo_ga_code" name="wporigo_ga_options[wporigo_ga_code]" cols="50" rows="10">%s</textarea>',
		! empty( $options['wporigo_ga_code'] ) ? esc_attr( $options['wporigo_ga_code']) : ''
	);

}


?>
