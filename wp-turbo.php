<?php
/**
 * Plugin Name: WP Turbo
 * Plugin URI: https://www.1815.nl
 * Description: Symfony UX Turbo (Frames + Streams) for WordPress.
 * Version: 0.1.0
 * Requires PHP: 8.3
 * Author: 1815
 * Author URI: https://www.1815.nl
 *
 * @package AchttienVijftien\Plugin\WpTurbo
 */

// The bundles self-register through composer autoload.files (this package's
// vendor when loaded standalone via a mu-plugin loader; the consuming
// project's vendor when required at project level). The guard keeps a double
// load harmless.
if (
	! \function_exists( 'AchttienVijftien\Bundle\WpTurboBundle\register_bundles' )
	&& is_readable( __DIR__ . '/vendor/autoload.php' )
) {
	require __DIR__ . '/vendor/autoload.php';
}
