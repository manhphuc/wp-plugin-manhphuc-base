<?php
/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 7/30/18
 * Time: 3:40 PM
 */

namespace ManhPhuc\Wp\ManhPhucBase\Base;

use Aura\Di\ContainerBuilder;
use Aura\Di\Container;

class WebApp {
	/* @var static $_instance */
	protected static $_instance = null;

	// Find out more here https://github.com/auraphp/Aura.Di/blob/3.x/docs/index.md
	/* @var Container $_di */
	protected static $_di = null;

	/* @var array $_container */
	protected $_container = null;

	/* @var array $_config */
	protected $_config = null;

	public function __construct( $config ) {
		$this->_config = $config;
	}

	/**
	 * Initialize the singleton of application
	 *
	 * @param $config
	 *
	 * @return void
	 */
	public static function initialize( $config ) {
		if ( null === static::$_instance ) {
			static::$_instance = new static( $config );
		}

		if ( null === static::$_di ) {
			$builder     = new ContainerBuilder();
			static::$_di = $builder->newInstance();
		}
	}

	/**
	 * Getter - Get the singleton of application
	 * @return static
	 */
	public static function instance() {
		if ( null === static::$_instance ) {
			die( 'WebApp singleton object not created yet. Please `initialize` it' );
		} else {
			return static::$_instance;
		}
	}

	/**
	 * Get component of application from container of components
	 * @param $component_name_to_get
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function __get( $component_name_to_get ) {
		if ( ! isset( $this->_container[ $component_name_to_get ] ) || ! $this->_container[ $component_name_to_get ] ) {
			$this->_container[ $component_name_to_get ] = null;
			if ( isset( $this->_config['components'] ) && ( $components = $this->_config['components'] ) && ( isset( $components[ $component_name_to_get ] ) && $component_args = $components[ $component_name_to_get ] ) ) {
				if ( isset( $component_args['class'] ) && $component_class = $component_args['class'] ) {
					unset( $component_args['class'] );

					try {
						// Todo: Refactor this to allow 1 config only
						$builder     = new ContainerBuilder();
						$di = $builder->newInstance();
						$di->params[ $component_class ][0]          = $component_args;
						$this->_container[ $component_name_to_get ] = $di->newInstance( $component_class );
					} catch ( \Exception $e ) {
						echo sprintf( 'Class `%s` initialized invalid', $component_class )."\n";
						throw $e;
					}
				}
			}
		}

		return $this->_container[ $component_name_to_get ];
	}
}