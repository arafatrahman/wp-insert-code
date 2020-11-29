<?php

/**
 * Plugin Name: WP Insert Code
 * Plugin URI: http://www.kuaniaweb.com
 * Description: Wp insert code plugin helps you to insert code/text in the header ( <head> ),footer( </body> ) and body<body> tag of your WordPress websites
 * Version: 0.0.1
 * Author: Arafat Rahman Riyad
 * Author URI: Author's website
 */
define("WPIC_PATH", dirname(__FILE__));
define('WPIC_ASSETS_DIR_URI', plugins_url('assets', __FILE__));

function WPIC_plugin_load() {
    if (is_admin()) {
        include_once WPIC_PATH . "/classes/wpic-settings.php";
        include_once WPIC_PATH . "/classes/wp-insert-code-admin.php";
        wpic_admin::Init();
    }
}

WPIC_plugin_load();
add_action('admin_enqueue_scripts', 'wpic_admin_styles');


function wpic_admin_styles() {
    wp_enqueue_style('wpic_admin', plugins_url('assets/css/wpic-admin-style.css', __FILE__), array(), '0.0.1');
    wp_enqueue_script('wpic_main', plugins_url('assets/js/wpic-main.js', __FILE__), array(), '0.0.1');
    
}

if (!function_exists('KAU_GET')) {

    function KAU_GET($key, $array = false) {

        if ($array) {
            return filter_input(INPUT_GET, $key, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        }

        if (filter_input(INPUT_GET, $key)) {
            return filter_input(INPUT_GET, $key);
        }

        return false;
    }

}

if (!function_exists('KAU_POST')) {

    function KAU_POST($key, $array = false) {
        if ($array) {
            return filter_input(INPUT_POST, $key, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        }
        if (filter_input(INPUT_POST, $key)) {
            return filter_input(INPUT_POST, $key);
        }
        return false;
    }

}

if (!function_exists('kauget')) {

    function kauget($name, $array = null) {

        if (!isset($array)) {
            return KAU_GET($name);
        }

        if (is_array($array)) {
            if (isset($array[$name])) {
                return wp_unslash($array[$name]);
            }
            return false;
        }

        if (is_object($array)) {
            if (isset($array->$name)) {
                return wp_unslash($array->$name);
            }
            return false;
        }

        return false;
    }

}