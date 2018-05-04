<?php
/**
 * Created by PhpStorm.
 * User: sau
 * Date: 15.03.18
 * Time: 10:10
 */

namespace Sau\WP\Ajax;


use Sau\Lib\Action;

/**
 * Class for register new  wp ajax
 * @package Sau\WP\Ajax
 */
class SAjax {
	/**
	 * @var string
	 */
	protected $name;

	/**
	 * SAjax constructor.
	 *
	 * @param string   $name     Ajax name
	 * @param callable $callback Callback function (NOT USE ATTRIBUTES). If null then called $this->handler()
	 */
	public function __construct( string $name, $callback = null ) {
		SAjaxRegistered::setNames( $name );
		$this->name = $name;
		$this->addScriptPath();
		if ( is_callable( $callback ) ) {
			SAjaxActions::wpAjax( $name, $callback );
		} else {
			SAjaxActions::wpAjax( $name, [ $this, 'handler' ] );
		}
	}

	/**
	 * Your handler
	 *
	 * @return void
	 */
	public function handler() {
		echo json_encode( [ 'data' => "Ajax {$this->name} is registered" ] );
		die();
	}

	/**
	 * Get ajax name
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	private function addScriptPath() {
		$name     = $this->getName();
		$base_url = get_admin_url();
		Action::wpHead( function () use ( $name, $base_url ) {
			echo "<script type=\"text/javascript\">window.{$name}='{$base_url}admin-ajax.php?action={$name}'</script>";
		}, 1 );
	}

	/**
	 * Generate response json
	 *
	 * @param boolean $status Status response
	 * @param mixed   $data   Custom data
	 * @param array   $args   Array arguments for add in response before converted to json
	 *
	 * @return string
	 */
	public static function response( bool $status = false, $data = null, array $args = [] ): string {
		$return = array_merge( [
			'status' => (int) $status,
			'data'   => $data
		], $args );

		return json_encode( $return );
	}

}