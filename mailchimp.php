<?php 
/*
Plugin Name: MailChimp Form
Plugin URI:  
Description: 
Version: 1.0.0
Author: Condence
Author URI: http://twitter.com/DavidCondence
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.txt
Text Domain: MailChimp-Form
Domain Path: /lang
*/
namespace MailChimp_Form;

defined('ABSPATH') or die("Direct access not allowed");

define( 'MCF_PLUGIN', plugins_url( '', __FILE__ ) );
define( 'MCF_PLUGIN_PATH', plugin_basename( dirname( __FILE__ ) ) );
define( 'MCF_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'MCF_PLUGIN_VERSION', '1.0.0' );
define( 'MCF_WP_VERSION', get_bloginfo( 'version' ) );

add_action( 'plugins_loaded', function(){
  load_plugin_textdomain( 'MailChimp-Form', false, MCF_PLUGIN_PATH . '/lang' );
} ); 
if( is_admin() ){ 
	require 'admin/admin.php'; 
} 