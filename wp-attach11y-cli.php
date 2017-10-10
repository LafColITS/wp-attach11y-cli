<?php
/*
Plugin Name: WP Attachment Accessibility CLI
Version: 0.0.1
Description: A CLI interface for attachment accessibility reporting.
Author: Lafayette College ITS
License: MIT
*/

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once dirname( __FILE__ ) . '/cli.php';
}
