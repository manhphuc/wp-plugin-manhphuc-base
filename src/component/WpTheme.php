<?php
/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 7/30/18
 * Time: 4:36 PM
 */

namespace ManhPhuc\Wp\ManhPhucBase\Component;


use ManhPhuc\Wp\ManhPhucBase\Base\Component;

class WpTheme extends Component {
	/* @var string represent current version of theme */
	public $version;
	/* @var string for theme translation */
	public $text_domain;
	/* @var bool choose to load popular assets from CDN or not */
	public $use_cdn = false;
	public $base_path;
	public $base_url;
	public $child_base_path;
	public $child_base_url;

	/* @var \Snscripts\HtmlHelper\Html $html_helper */
	public $html_helper = null;

	/**
	 * Instance constructor.
	 * Initialize values for object based on configuration array
	 *
	 * @param array $config
	 */
	public function __construct( $config ) {
		parent::__construct( $config );

		// Init Html Helper
		// Find out more here https://github.com/mikebarlow/html-helper
		$this->html_helper = new \Snscripts\HtmlHelper\Html(
			new \Snscripts\HtmlHelper\Helpers\Form(
				new \Snscripts\HtmlHelper\Interfaces\BasicFormData()
			),
			new \Snscripts\HtmlHelper\Interfaces\BasicRouter(),
			new \Snscripts\HtmlHelper\Interfaces\BasicAssets()
		);
	}

	/**
	 * Initialize theme with hooks
	 */
	public function initialize() {

	}
}