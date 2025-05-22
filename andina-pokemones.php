<?php
/**
 * Plugin Name: Andina Pokemones
 * Description: CPT de Pokemones con filtros desde PokéAPI
 * Version: 1.0
 * Author: Benjamin Oscco Arias
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ANDINA_POKEMONES_PATH', plugin_dir_path(__FILE__));
define('ANDINA_POKEMONES_URL', plugin_dir_url(__FILE__));

require_once ANDINA_POKEMONES_PATH . 'inc/cpt-setup.php';
require_once ANDINA_POKEMONES_PATH . 'inc/api-helper.php';
require_once ANDINA_POKEMONES_PATH . 'inc/shortcode-handler.php';
require_once ANDINA_POKEMONES_PATH . 'inc/admin-importer.php';

function andina_pokemones_activate() {
    andina_register_cpt();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'andina_pokemones_activate');

function andina_pokemones_enqueue_styles() {
    wp_enqueue_style('andina-pokemones-style', ANDINA_POKEMONES_URL . 'assets/style.css');
}
add_action('wp_enqueue_scripts', 'andina_pokemones_enqueue_styles');
