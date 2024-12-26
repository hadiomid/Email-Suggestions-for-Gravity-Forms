<?php
/*
Plugin Name:  Email Suggestions for Gravity Forms
Description:  Adds email domain suggestions to email fields in Gravity Forms.
Version:      1.1.0
Plugin URI:   https://profiles.wordpress.org/hadiomid/
Author:       Hadi Omid
Author URI:   https://profiles.wordpress.org/hadiomid/
Text Domain:  gf-email-suggestions
License:      GPLv2 or later
License URI:  http://www.gnu.org/licenses/gpl-2.0.html
*/

// Prevent direct access to the file.
if (!defined('ABSPATH')) {
    exit;
}

// Check if a Gravity Form is present on the page
function gf_has_gravity_form() {
    global $post;
    if (isset($post->post_content) && has_shortcode($post->post_content, 'gravityform')) {
        return true;
    }
    return false;
}

// Check if the Gravity Form contains an email field
function gf_form_has_email_field($form) {
    foreach ($form['fields'] as $field) {
        if ($field->type === 'email') {
            return true;
        }
    }
    return false;
}

// Enqueue scripts and styles only if conditions are met
function enqueue_email_suggestions_script() {
    // Check for Gravity Form shortcode on the page
    if (gf_has_gravity_form()) {
        // Hook into Gravity Forms' rendering process to check for email fields
        add_filter('gform_pre_render', 'check_email_field_and_enqueue');
    }
}

add_action('wp_enqueue_scripts', 'enqueue_email_suggestions_script');

// Check if the form contains an email field and enqueue scripts if true
function check_email_field_and_enqueue($form) {
    if (gf_form_has_email_field($form)) {
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
    return $form;
}
