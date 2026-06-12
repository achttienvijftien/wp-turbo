<?php
/**
 * Frontend asset registration.
 *
 * @package AchttienVijftien\Plugin\WpTurbo
 */

namespace AchttienVijftien\Plugin\WpTurbo;

/**
 * The default Turbo runtime carrier.
 *
 * Registers the runtime script from the webpack manifest and enqueues it
 * when wp-turbo-bundle announces a printed frame placeholder through the
 * wp_turbo/frame_placeholder action, so the script only ships on pages
 * that actually use it. A theme bundling its own Turbo runtime replaces
 * this by listening to the same action. Footer + defer is fine: frames
 * load on/after page load anyway.
 *
 * @package AchttienVijftien\Plugin\WpTurbo
 */
class Asset {

	/**
	 * Script handle consumers enqueue.
	 */
	public const RUNTIME_HANDLE = 'wp-turbo-runtime';

	/**
	 * Asset constructor.
	 *
	 * @param string $plugin_dir Absolute path to the plugin directory.
	 */
	public function __construct( private readonly string $plugin_dir ) {
	}

	/**
	 * Adds WordPress hooks.
	 *
	 * @return void
	 */
	public function add_hooks(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'register_runtime' ] );
		add_action( 'wp_turbo/frame_placeholder', [ $this, 'enqueue_runtime' ] );
	}

	/**
	 * Enqueues the runtime; fired per printed frame placeholder.
	 *
	 * Placeholders print after wp_enqueue_scripts ran, which is fine for a
	 * footer script; should one ever print before registration, WordPress
	 * parks the enqueue and promotes it when register_runtime() runs.
	 *
	 * @return void
	 */
	public function enqueue_runtime(): void {
		wp_enqueue_script( self::RUNTIME_HANDLE );
	}

	/**
	 * Registers the runtime script by manifest lookup.
	 *
	 * @return void
	 */
	public function register_runtime(): void {
		$manifest_path = $this->plugin_dir . '/dist/manifest.json';

		if ( ! is_readable( $manifest_path ) ) {
			return;
		}

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$manifest = json_decode( (string) file_get_contents( $manifest_path ), true );

		if ( empty( $manifest['runtime.js'] ) ) {
			return;
		}

		wp_register_script(
			self::RUNTIME_HANDLE,
			home_url( $manifest['runtime.js'] ),
			[],
			null, // The content hash in the filename is the version.
			[
				'in_footer' => true,
				'strategy'  => 'defer',
			]
		);
	}
}
