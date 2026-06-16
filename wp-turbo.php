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

// Load this package's own autoloader when running standalone (its own vendor),
// unless the consuming project's autoloader already registered the classes.
// The guard keeps a double load harmless.
if (
	! \class_exists( \AchttienVijftien\Plugin\WpTurbo\Asset::class )
	&& is_readable( __DIR__ . '/vendor/autoload.php' )
) {
	require __DIR__ . '/vendor/autoload.php';
}

// Class_exists guards the standalone case where no autoloader knows the
// package yet (e.g. a bare checkout without composer install).
if ( class_exists( \AchttienVijftien\Plugin\WpTurbo\Asset::class ) ) {
	( new \AchttienVijftien\Plugin\WpTurbo\Asset( __DIR__ ) )->add_hooks();
}
