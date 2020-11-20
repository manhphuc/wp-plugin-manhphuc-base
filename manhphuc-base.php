<?php
/**
 * Plugin Name: ManhPhuc Base
 * Description: The Base plugin for Theme and Plugin development. It requires ACF pro to work.
 * Version: 0.0.1
 * Author: manhphucofficial@gmail.com
 * Author URI: http://www.yivic.com/wordpress-plugin-manhphuc-base
 * License: GPLv2 or later
 * Text Domain: manhphuc
 * Domain Path: /languages/
 */

defined( 'MANHPHUC_BASE_PLUGIN_VER' ) || define( 'MANHPHUC_BASE_PLUGIN_VER', 0.2 );
defined( 'MANHPHUC_BASE_PLUGIN_FOLDER_NAME' ) || define( 'NP_PLUGIN_CORE_NAME', 'manhphuc-core' );
defined( 'MANHPHUC_BASE_PLUGIN_URL' ) || define( 'MANHPHUC_BASE_PLUGIN_URL', plugins_url( NP_PLUGIN_CORE_NAME ) );
defined( 'MANHPHUC_BASE_PLUGIN_PATH' ) || define( 'MANHPHUC_BASE_PLUGIN_PATH', __DIR__ );
defined( 'MANHPHUC_BASE_PLUGIN_ASSETS_URL' ) || define( 'MANHPHUC_BASE_PLUGIN_ASSETS_URL', plugins_url( NP_PLUGIN_CORE_NAME ) . DIRECTORY_SEPARATOR . 'assets' );

! file_exists(__DIR__ . "/vendor/autoload.php") || require_once (__DIR__ . "/vendor/autoload.php");

class ManhPhucBase {
    public static $text_domain = 'manhphuc';

    static function activate() {
        // do not generate any output

        // Require ACF pro
        $plugin = 'advanced-custom-fields-pro/acf.php';
        if ( ! is_plugin_active( $plugin ) ) {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            die( __( 'ManhPhuc Base plugin requires ACF pro', _NP_TEXT_DOMAIN ) );
        }
    }
}

register_activation_hook( __FILE__, array( 'ManhPhucBase', 'activate' ) );


