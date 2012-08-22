<?php
/*
Plugin Name: QR code for Advanced Custom Fields
Plugin URI: 
Description: This addon creates a QR code for URL.
Version: 1.0
Author: Fumito MIZUNO
Author URI: http://wp.php-web.net/
License: GPL
*/

if (function_exists('register_field')){
register_field('QRCode_field', WP_PLUGIN_DIR . '/qrcode-acf/qrcode_field.php');
}	
