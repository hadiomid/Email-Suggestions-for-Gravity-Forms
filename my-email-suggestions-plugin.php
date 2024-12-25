<?php
/*
Plugin Name: Email Suggestions for Gravity Forms
Description: Adds email domain suggestions to email fields in Gravity Forms.
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
        'email-validation-style',
        plugin_dir_url(__FILE__) . 'css/email-validation-style.css',
        array(),
        null
    );
}

add_action('wp_enqueue_scripts', 'enqueue_email_suggestions_script');
