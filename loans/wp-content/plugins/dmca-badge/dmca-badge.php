<?php
/*
Plugin Name: DMCA Website Protection Badge
Plugin URI: http://www.google.com/
Description: Protect your content with a DMCA.com Website Protection Badge. Our badges deter content theft, provide tracking of unauthorized usage (with account), and make takedowns easier and more effective. Visit the plugin site to learn more about DMCA Website Protection Badges, or to register.
Version:           1.6.1
Author:            DMCA.com
Author URI:        http://wordpress.org/plugins/dmca-badge/
Plugin URI:        http://dmca.com
License: GPLv2
 */

require( dirname( __FILE__ ) . '/libraries/imperative/imperative.php' );

require_library( 'restian', '0.4.1',  __FILE__, 'libraries/restian/restian.php' );
require_library( 'sidecar', '0.5.1', __FILE__, 'libraries/sidecar/sidecar.php' );
require_library( 'dmca-api-client', '0.1.0', __FILE__, 'libraries/dmca-api-client/dmca-api-client.php' );

register_plugin_loader( __FILE__ );

