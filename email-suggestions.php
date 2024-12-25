<?php
/*
Plugin Name: Email Suggestions for Gravity Forms
Description: This plugin improves the Gravity Forms email field. It makes email entry easier, reduces mistakes, and helps users enter emails correctly.
Version: 1.0
Author: Hadi
Requires Plugins: gravityforms/gravityforms.php
*/

// Prevent direct access to the file.
if (!defined('ABSPATH')) {
    exit;
}

function enqueue_email_suggestions_script() {
    wp_enqueue_script(
        'email-suggestions',
        plugin_dir_url(__FILE__) . 'js/email-suggestions.js',
        array('jquery'),
        null,
        true
    );
	
	
	wp_enqueue_style(
        'email-suggestions',
        plugin_dir_url(__FILE__) . 'css/email-suggestions.css',
        array(),
        null
    );
}

add_action('wp_enqueue_scripts', 'enqueue_email_suggestions_script');
