<?php
/*
Plugin Name: WPOrigo Google Analytics
Plugin URI: http://wporigo.com
Description: Google Analytics plugin for WordPress
Author: Elod Horvath
Version: 1.0.3
Author URI: 
License: http://www.gnu.org/licenses/gpl.html
Copyright &copy; 2014- Elod Horvath
*/


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


function wporigo_ga() { 

	$options = get_option( 'wporigo_ga_options' );

	echo $options['wporigo_ga_code'];
 
} 
add_action('wp_head', 'wporigo_ga');

require( 'lib/actions.php' );

?>
