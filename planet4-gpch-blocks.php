<?php
/**
 * Plugin Name: Planet4 - GPCH Blocks
 * Description: Creates additional content blocks in Planet4 for GPCH (using shortcake)
 * Plugin URI: http://github.com/greenpeace/planet4-plugin-blocks
 * Version: 0.1
 *
 * Author: Greenpeace Switzerland
 * Author URI: http://www.greenpeace.ch/
 * Text Domain: planet4-gpch-blocks
 *
 * License:     GPLv3
 * Copyright (C) 2019 Greenpeace Switzerland
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || die( 'Direct access is forbidden !' );


/*
========================
    C O N S T A N T S
========================
*/

if ( ! defined( 'P4CHBKS_REQUIRED_PHP' ) ) {
    define( 'P4CHBKS_REQUIRED_PHP', '7.0' );
}
if ( ! defined( 'P4CHBKS_REQUIRED_PLUGINS' ) ) {
    define(
        'P4CHBKS_REQUIRED_PLUGINS',
        [
            'timber'    => [
                'min_version' => '1.3.0',
                'rel_path'    => 'timber-library/timber.php',
            ],
            'shortcake' => [
                'min_version' => '0.7.0',
                'rel_path'    => 'shortcode-ui/shortcode-ui.php',
            ],
        ]
    );
}
if ( ! defined( 'P4CHBKS_PLUGIN_BASENAME' ) ) {
    define( 'P4CHBKS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'P4CHBKS_PLUGIN_DIRNAME' ) ) {
    define( 'P4CHBKS_PLUGIN_DIRNAME', dirname( P4CHBKS_PLUGIN_BASENAME ) );
}
if ( ! defined( 'P4CHBKS_PLUGIN_DIR' ) ) {
    define( 'P4CHBKS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . P4CHBKS_PLUGIN_DIRNAME );
}
if ( ! defined( 'P4CHBKS_PLUGIN_NAME' ) ) {
    define( 'P4CHBKS_PLUGIN_NAME', 'Planet4 GPCH Blocks' );
}
if ( ! defined( 'P4CHBKS_PLUGIN_SHORT_NAME' ) ) {
    define( 'P4CHBKS_PLUGIN_SHORT_NAME', 'Blocks' );
}
if ( ! defined( 'P4CHBKS_PLUGIN_SLUG_NAME' ) ) {
    define( 'P4CHBKS_PLUGIN_SLUG_NAME', 'blocks' );
}
if ( ! defined( 'P4CHBKS_INCLUDES_DIR' ) ) {
    define( 'P4CHBKS_INCLUDES_DIR', P4CHBKS_PLUGIN_DIR . '/includes/' );
}
if ( ! defined( 'P4CHBKS_ASSETS_DIR' ) ) {
    define( 'P4CHBKS_ASSETS_DIR', plugins_url( P4CHBKS_PLUGIN_DIRNAME . '/assets/' ) );
}
if ( ! defined( 'P4CHBKS_ADMIN_DIR' ) ) {
    define( 'P4CHBKS_ADMIN_DIR', plugins_url( P4CHBKS_PLUGIN_DIRNAME . '/admin/' ) );
}
if ( ! defined( 'P4CHBKS_LANGUAGES' ) ) {
    define(
        'P4CHBKS_LANGUAGES',
        [
            'en_US' => 'English',
        ]
    );
}
if ( ! defined( 'P4CHBKS_COVERS_NUM' ) ) {
    define( 'P4CHBKS_COVERS_NUM', 30 );
}
if ( ! defined( 'P4CHBKS_ALLOWED_PAGETYPE' ) ) {
    define( 'P4CHBKS_ALLOWED_PAGETYPE', [ 'page' ] );
}
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    define( 'WP_UNINSTALL_PLUGIN', P4CHBKS_PLUGIN_BASENAME );
}

require_once __DIR__ . '/vendor/autoload.php';
require_once ABSPATH . 'wp-admin/includes/plugin.php';

// autoload doesn't work
require_once __DIR__ . '/classes/class-loader.php';
require_once __DIR__ . '/classes/view/class-view.php';
require_once __DIR__ . '/classes/controller/blocks/class-controller.php';
require_once __DIR__ . '/classes/controller/blocks/class-quote-controller.php';

/*
==========================
    L O A D  P L U G I N
==========================
*/
P4CHBKS\Loader::get_instance(
    [
        // --- Add here your own Block Controller ---
        'P4CHBKS\Controllers\Blocks\GPCH_quote_Controller',
    ],
    'P4CHBKS\Views\View'
);
