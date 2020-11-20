<?php
/**
 * Created by PhpStorm.
 * User: phucnguyen
 * Date: 7/30/18
 * Time: 4:13 PM
 */

namespace ManhPhuc\Wp\ManhPhucBase\Base;


class Component {

	/**
	 * Component constructor.
	 * Initialize values for object based on configuration array
	 *
	 * @param null|array $config
	 */
	public function __construct( $config = null ) {
		if ( ! empty( $config ) ) {
			foreach ( (array) $config as $key => $value ) {
				if ( property_exists( get_class( $this ), $key ) ) {
					$this->$key = $value;
				}
			}
		}
	}
}