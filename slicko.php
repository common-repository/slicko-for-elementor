<?php 
/*
Plugin Name: Slicko For Slicko Theme
Plugin URI: https://wordpress.org/plugins/slicko-for-elementor/
Description: The Slicko is an Elementor helping plugin that will make your designing work easier.
Our specialities are custom CSS, Nested section, Creative Buttons.
Version: 1.2.1
Author: wpgrids
Author URI: https://profiles.wordpress.org/wpgrids/
License: GPLv2 or later
Text Domain: slicko
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//Set plugin version constant.
define( 'SLICKO_VERSION', '1.2.0');
/* Set constant path to the plugin directory. */
define( 'SLICKO_WIDGET', trailingslashit( plugin_dir_path( __FILE__ ) ) );
// Plugin Function Folder Path
define( 'SLICKO_WIDGET_INC', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'SLICKO_WIDGET_LIB', plugin_dir_path( __FILE__ ) . 'lib/' );

// Plugin Extensions Folder Path
define( 'SLICKO_WIDGET_EXTENSIONS', plugin_dir_path( __FILE__ ) . 'extensions/' );

// Plugin Widget Folder Path
define( 'SLICKO_WIDGET_DIR', plugin_dir_path( __FILE__ ) . 'widgets/' );

// Assets Folder URL
define( 'SLICKO_ASSETS_PUBLIC', plugins_url( 'assets', __FILE__ ) );

// Assets Folder URL
define( 'SLICKO_ASSETS_VERDOR', plugins_url( 'assets/vendor', __FILE__ ) );




require_once(SLICKO_WIDGET_INC . 'helper-function.php');
require_once(SLICKO_WIDGET_INC . 'demo-setup.php');
require_once(SLICKO_WIDGET_INC . 'elmentor-extender.php');
require_once(SLICKO_WIDGET_INC . 'cpt.php');
require_once(SLICKO_WIDGET_INC . 'Metabox/header-footer.php');
require_once(SLICKO_WIDGET_INC . 'Metabox/nav.php');
require_once(SLICKO_WIDGET_INC . 'Classes/breadcrumb-class.php');
require_once(SLICKO_WIDGET_INC . 'Traits/creative-button-murkup.php');
require_once(SLICKO_WIDGET_INC . 'Traits/inline-button-murkup.php');
require_once(SLICKO_WIDGET_LIB . 'ocdi/ocdi.php');


require_once( SLICKO_WIDGET . 'base.php' );

?>
