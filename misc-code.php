<?php
/**
 * Plugin Name: Misc Code
 * Description: A simple plugin to add miscellaneous code snippets to the website.
 * Version: 1.0.6
 * Author: Ray Flores
 * Author URI: https://rayflores.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/class-updater-checker.php';

use Misc_Code\Updater_Checker;

$github_username        = 'rayflores'; // Use your gitbub username.
$github_repository      = 'misccode'; // Use your repository name.
$plugin_basename        = plugin_basename( __FILE__ ); // Check note below.
$plugin_current_version = '1.0.6'; // Use the current version of the plugin.

$updater = new Updater_Checker(
	$github_username,
	$github_repository,
	$plugin_basename,
	$plugin_current_version
);
$updater->set_hooks();

/**
 * The main plugin class
 *
 * @since 1.0
 * @package MiscCode
 * @category Class
 */
class Misc_Code {
	/**
	 * The instance of the class
	 */
	private static $instance;

	/**
	 * The constructor
	 *
	 * @since 1.0
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_wpml_scripts' ) );
	}

	/**
	 * Dequeue WPML scripts
	 *
	 * @since 1.0
	 */
	public function dequeue_wpml_scripts() {
		wp_dequeue_style( 'wpml-legacy-horizontal-list-0' );
	}

	/**
	 * Get the instance of the class
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
Misc_Code::get_instance();
