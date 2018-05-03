<?php
/**
 * Created by PhpStorm.
 * User: sau
 * Date: 15.03.18
 * Time: 9:15
 */

namespace Sau\WP\Ajax;


use Sau\Lib\Base\BaseAction;

class SAjaxActions extends BaseAction {

	/**
	 * for hock after_setup_theme
	 *
	 * @param string   $ajax_name Ajax name
	 * @param callable $callback  Callback function
	 * @param int      $priority
	 * @param int      $accepted_args
	 */
	public static function wpAjax( string $ajax_name, callable $callback, $priority = null, $accepted_args = null ) {
		self::action( 'wp_ajax_' . $ajax_name, $callback, $priority, $accepted_args );
		self::action( 'wp_ajax_nopriv_' . $ajax_name, $callback, $priority, $accepted_args );
	}
}