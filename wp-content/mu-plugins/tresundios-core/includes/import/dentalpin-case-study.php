<?php
/**
 * Creates the DentalPin India case study as a DRAFT (idempotent; never touches a published copy).
 *
 * Run from the WordPress root:
 *   wp eval-file wp-content/mu-plugins/tresundios-core/includes/import/dentalpin-case-study.php
 *
 * Without WP-CLI use Tools → "DentalPin case study" in WP Admin instead. Both run the same code
 * (includes/admin/dentalpin-case-study-tool.php).
 *
 * @package Tresundios\Core
 */

if ( ! defined( 'ABSPATH' ) || ! defined( 'WP_CLI' ) || ! WP_CLI ) {
	exit;
}

require_once TRESUNDIOS_CORE_DIR . '/includes/admin/dentalpin-case-study-tool.php';

$tresundios_result = tresundios_create_dentalpin_case_study();
if ( is_wp_error( $tresundios_result ) ) {
	WP_CLI::error( $tresundios_result->get_error_message() );
}

WP_CLI::success( sprintf( 'Draft case study #%d ready: %s', $tresundios_result['id'], get_edit_post_link( $tresundios_result['id'], 'raw' ) ) );
WP_CLI::log( 'Next: set the featured image, then publish. Real load-time, cost and clinic-count metrics are still open: see the TODO comments in the Results block.' );
