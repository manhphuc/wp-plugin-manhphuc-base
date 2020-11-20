<?php
/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 7/31/18
 * Time: 3:28 PM
 */

namespace ManhPhuc\Wp\ManhPhucBase;


class Wp {

	/**
	 * Get content of a template block for the layout with params
	 * Template file should be in `templates` folder of child theme, parent theme or of this plugin
	 *
	 * @param string $template_slug name of the template
	 * @param array $params arguments needed to be sent to the view
	 *
	 * @return string
	 */
	public static function get_template_part( $template_slug, $params = [] ) {
		// Todo: add object cache function for template
		extract( $params );
		$template_default_path     = MANHPHUC_BASE_PLUGIN_PATH . DIRECTORY_SEPARATOR . $template_slug . '.php';
		$template_theme_path       = get_template_directory() . DIRECTORY_SEPARATOR . $template_slug . '.php';
		$template_child_theme_path = get_stylesheet_directory() . DIRECTORY_SEPARATOR . $template_slug . '.php';
		ob_start();
		if ( file_exists( $template_child_theme_path ) ) {
			include $template_child_theme_path;
		} else if ( file_exists( $template_theme_path ) ) {
			include $template_theme_path;
		} else if ( file_exists( $template_default_path ) ) {
			include( $template_default_path );
		}
		$result = ob_get_contents();
		ob_end_clean();

		return $result;
	}

	/**
	 * Escape a rich text field entered from Admin
	 *
	 * @param $content
	 *
	 * @return string
	 */
	public static function esc_editor_field( $content ) {
		return wp_kses_post( $content );
	}

	/**
	 * Load Font Awesome
	 *
	 * @param bool $use_cdn
	 */
	public static function load_font_awesome( $use_cdn = false ) {
		wp_enqueue_style( 'font-awesome', $use_cdn ? '//use.fontawesome.com/releases/v5.2.0/css/all.css' : MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css', array(), MANHPHUC_BASE_PLUGIN_VER, 'all' );
	}

	/**
	 * Load BxSlider assets
	 *
	 * @param bool $use_cdn
	 */
	public static function load_bxslider( $use_cdn = false ) {
		wp_enqueue_style( 'bxslider', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css' : MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/bxslider-4/dist/jquery.bxslider.min.css', array(), MANHPHUC_BASE_PLUGIN_VER, 'screen' );

		wp_enqueue_script( 'bxslider', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js' : MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/bxslider-4/dist/jquery.bxslider.min.js', [ 'jquery' ], MANHPHUC_BASE_PLUGIN_VER, true );
	}

	/**
	 * Load Modernizr to detect the browser features
	 *
	 * @param bool $use_cdn
	 */
	public static function load_modernizr( $use_cdn = false ) {
		wp_enqueue_script( 'modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', [], MANHPHUC_BASE_PLUGIN_VER, true );
	}

	/**
	 * Load Detectizr to detect client device
	 *
	 * @param bool $use_cdn
	 */
	public static function load_detectizr( $use_cdn = false ) {
		static::load_modernizr( $use_cdn );
		wp_enqueue_script( 'detectizr', '//cdnjs.cloudflare.com/ajax/libs/detectizr/2.2.0/detectizr.min.js', [ 'modernizr' ], MANHPHUC_BASE_PLUGIN_VER, true );
	}

	/**
	 * Load Color box resources
	 *
	 * @param bool $use_cdn
	 */
	public static function load_colorbox( $use_cdn = false ) {
		wp_enqueue_style( 'colorbox', $use_cdn ? '//cdn.jsdelivr.net/npm/jquery-colorbox@1.6.4/example3/colorbox.css' : '//cdn.jsdelivr.net/npm/jquery-colorbox@1.6.4/example3/colorbox.css', array(), MANHPHUC_BASE_PLUGIN_VER, 'screen' );
		wp_enqueue_script( 'colorbox', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/jquery.colorbox-min.js' : MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/jquery-colorbox/jquery.colorbox-min.js', [ 'jquery' ], MANHPHUC_BASE_PLUGIN_VER, true );
	}

	/**
	 * Load css for animation
	 * https://daneden.github.io/animate.css/
	 *
	 * @param bool $use_cdn
	 */
	public static function load_animate_css( $use_cdn = false ) {
		wp_enqueue_style( 'animate-css', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css' : '//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css', array(), MANHPHUC_BASE_PLUGIN_VER, 'screen' );
	}

	/**
	 * Load imagesLoaded jquery plugin
	 * http://desandro.github.com/imagesloaded/
	 *
	 * @param bool $use_cdn
	 */
	public static function load_images_loaded( $use_cdn = false ) {
		wp_enqueue_script( 'images-loaded', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.4/imagesloaded.pkgd.min.js' : MANHPHUC_BASE_PLUGIN_ASSETS_URL . '/imagesloaded/imagesloaded.pkgd.min.js', [ 'jquery' ], MANHPHUC_BASE_PLUGIN_VER, true );
	}

	/**
	 * Load isotope for sorting items arbitrary
	 * https://isotope.metafizzy.co/
	 *
	 * @param bool $use_cdn
	 */
	public static function load_isotope( $use_cdn = false ) {
		wp_enqueue_script( 'isotope', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js' : '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js', [ 'jquery' ], MANHPHUC_BASE_PLUGIN_VER, true );
		wp_enqueue_script( 'isotope-fit-columns', $use_cdn ? '//cdn.jsdelivr.net/npm/isotope-fit-columns@1.1.4/fit-columns.min.js' : '//cdn.jsdelivr.net/npm/isotope-fit-columns@1.1.4/fit-columns.min.js', [ 'isotope' ], MANHPHUC_BASE_PLUGIN_VER, true );
		wp_enqueue_script( 'isotope-horizontal', $use_cdn ? '//cdn.jsdelivr.net/npm/isotope-horizontal@2.0.1/horizontal.min.js' : '//cdn.jsdelivr.net/npm/isotope-horizontal@2.0.1/horizontal.min.js', [ 'isotope' ], MANHPHUC_BASE_PLUGIN_VER, true );
		wp_enqueue_script( 'isotope-masonry-horizontal', $use_cdn ? '//cdn.jsdelivr.net/npm/isotope-masonry-horizontal@2.0.1/masonry-horizontal.min.js' : '//cdn.jsdelivr.net/npm/isotope-masonry-horizontal@2.0.1/masonry-horizontal.min.js', [ 'isotope' ], MANHPHUC_BASE_PLUGIN_VER, true );
		wp_enqueue_script( 'isotope-cells-by-row', $use_cdn ? '//cdn.jsdelivr.net/npm/isotope-cells-by-row@1.1.4/cells-by-row.min.js' : '//cdn.jsdelivr.net/npm/isotope-cells-by-row@1.1.4/cells-by-row.min.js', [ 'isotope' ], MANHPHUC_BASE_PLUGIN_VER, true );
		wp_enqueue_script( 'isotope-cells-by-column', $use_cdn ? '//cdn.jsdelivr.net/npm/isotope-cells-by-column@1.1.4/cells-by-column.min.js' : '//cdn.jsdelivr.net/npm/isotope-cells-by-column@1.1.4/cells-by-column.min.js', [ 'isotope' ], MANHPHUC_BASE_PLUGIN_VER, true );
		wp_enqueue_script( 'isotope-packery', $use_cdn ? '//cdn.jsdelivr.net/npm/isotope-packery@2.0.1/packery-mode.pkgd.min.js' : '//cdn.jsdelivr.net/npm/isotope-packery@2.0.1/packery-mode.pkgd.min.js', [ 'isotope' ], MANHPHUC_BASE_PLUGIN_VER, true );
	}

	/**
	 * Load fancybox 3 plugin
	 * https://fancyapps.com/fancybox/3/
	 *
	 * @param bool $use_cdn
	 */
	public static function load_fancybox( $use_cdn = false ) {
		wp_enqueue_style( 'fancybox', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css' : '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css', array(), MANHPHUC_BASE_PLUGIN_VER, 'screen' );
		wp_enqueue_script( 'fancybox', $use_cdn ? '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js' : '//cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js', [ 'jquery' ], MANHPHUC_BASE_PLUGIN_VER, true );
	}
}