<?php
/*
Plugin Name: Disable AI for Security
Description: Disables WordPress AI connectors and hides AI settings from admin. No settings.
Author: Limit Login Attempts Reloaded
Author URI: https://www.limitloginattempts.com/
Text Domain: disable-ai-for-security
Requires at least: 7.0
Requires PHP: 7.2
Version: 1.3.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Copyright 2026–present Limit Login Attempts Reloaded
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DAIFS_VERSION', '1.3.0' );

/**
 * Disable WordPress AI at the core API level (WP 7.0+).
 *
 * When false, core does not register default AI providers, rejects ai_provider
 * connectors, and the AI client does not run prompts.
 *
 * @see wp_supports_ai() in wp-includes/ai-client.php
 */
add_filter( 'wp_supports_ai', '__return_false' );

/**
 * Remove AI-related items from Settings in wp-admin.
 *
 * Priority 999 runs after core and plugins register their menus.
 */
add_action(
	'admin_menu',
	static function () {
		// Core Connectors screen (Settings → Connectors).
		remove_submenu_page( 'options-general.php', 'options-connectors.php' );
		// Connectors UI registered via admin.php?page=...
		remove_submenu_page( 'options-general.php', 'options-connectors-wp-admin' );
		// Optional WordPress AI plugin settings (slug: ai).
		remove_submenu_page( 'options-general.php', 'ai-wp-admin' );
	},
	999
);

/**
 * Block direct access to AI settings URLs if the menu slug is known.
 */
add_action(
	'admin_init',
	static function () {
		global $pagenow;

		// options-connectors.php is loaded directly, not via ?page=.
		$blocked = ( 'options-connectors.php' === $pagenow );

		if ( ! $blocked && isset( $_GET['page'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only redirect away from AI screens; no data is processed or stored.
			$page    = sanitize_text_field( wp_unslash( $_GET['page'] ) );
			$blocked = in_array( $page, array( 'options-connectors-wp-admin', 'ai-wp-admin' ), true );
		}

		if ( $blocked ) {
			wp_safe_redirect( admin_url() );
			exit;
		}
	}
);

/**
 * Green "AI Disabled" status badge on the left of the admin bar, after other left-side items.
 */
add_action(
	'admin_bar_menu',
	static function ( $wp_admin_bar ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$wp_admin_bar->add_node(
			array(
				'id'     => 'daifs-ai-disabled',
				'parent' => 'root-default',
				'title'  => '<span class="daifs-admin-bar-badge">' . esc_html__( 'AI Disabled', 'disable-ai-for-security' ) . '</span>',
				'href'   => false,
				'meta'   => array(
					'class' => 'daifs-ai-disabled-status',
					'title' => esc_attr__(
						'WordPress AI features are disabled on this site by the Disable AI for Security plugin.',
						'disable-ai-for-security'
					),
				),
			)
		);
	},
	99989
);

/**
 * Enqueue admin styles (menu hiding + admin bar badge). Loaded in wp-admin and when the toolbar is visible.
 */
$daifs_enqueue_admin_styles = static function () {
	if ( ! is_admin() && ! is_admin_bar_showing() ) {
		return;
	}

	wp_enqueue_style(
		'disable-ai-for-security-admin',
		plugins_url( 'assets/css/admin-hide-ai.css', __FILE__ ),
		array(),
		DAIFS_VERSION
	);
};

add_action( 'admin_enqueue_scripts', $daifs_enqueue_admin_styles );
add_action( 'wp_enqueue_scripts', $daifs_enqueue_admin_styles );
