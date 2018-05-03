<?php
/**
 * Created by PhpStorm.
 * User: sau
 * Date: 15.03.18
 * Time: 9:19
 */

namespace Sau\WP\Ajax;

use Sau\Lib\Notice;

/**
 * Class SAjaxRegistered
 * @package Sau\WP\Ajax
 */
final class SAjaxRegistered {
	/** SAjaxRegistered constructor. Block for disable create */
	protected function __construct() {
	}

	static protected $names = [];

	/**
	 * @return array return all names
	 */
	public static function _() {
		return self::$names;
	}

	/**
	 * Search ajax name. If ajax is registered return true, else false
	 *
	 * @param string $name
	 *
	 * @return bool
	 */
	public static function checkNames( string $name ): bool {
		if ( array_search( $name, self::$names ) !== false ) {
			return true;
		}

		return false;
	}

	/**
	 * Add new name in collect
	 *
	 * @param string $name
	 */
	public static function setNames( string $name ) {
		if ( self::checkNames( $name ) ) {
			Notice::warning( "Ajax '{$name}' is exist" );
		}
		self::$names[] = $name;
	}

}