<?php
/**
 * Created by PhpStorm.
 * User: manhphucofficial@yahoo.com
 * Date: 7/30/18
 * Time: 6:36 PM
 */

namespace ManhPhuc\Wp\ManhPhucBase;


class Common {
	/**
	 * Get content of a template block for the layout with params
	 * Template file should be in `templates` folder of child theme, parent theme or of this plugin
	 *
	 * @param string $template_slug name of the template
	 * @param array $params arguments needed to be sent to the view
	 *
	 * @return string
	 */
	public static function get_template_block( $template_slug, $params = [] ) {
		extract( $params );
		$template_plugin_path      = MANHPHUC_BASE_PLUGIN_PATH . DIRECTORY_SEPARATOR . $template_slug . '.php';
		$template_theme_path       = get_template_directory() . DIRECTORY_SEPARATOR . $template_slug . '.php';
		$template_child_theme_path = get_stylesheet_directory() . DIRECTORY_SEPARATOR . $template_slug . '.php';
		ob_start();
		if ( file_exists( $template_child_theme_path ) ) {
			include $template_child_theme_path;
		} else if ( file_exists( $template_theme_path ) ) {
			include $template_theme_path;
		} else if ( file_exists( $template_plugin_path ) ) {
			include( $template_plugin_path );
		}
		$result = ob_get_contents();
		ob_end_clean();

		return $result;
	}
}