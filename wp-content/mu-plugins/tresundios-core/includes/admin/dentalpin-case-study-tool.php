<?php
/**
 * Tools → "DentalPin case study": creates the DentalPin India case study as a DRAFT with one click,
 * for hosts without WP-CLI. Admin-only, nonce-protected and safe to run again (it refreshes a draft and
 * never overwrites a published copy). Also used by the WP-CLI script in includes/import/.
 *
 * Delete this file (and its require in tresundios-core.php) once the case study is published.
 *
 * No `translation_key` is set on purpose: tresundios.in presents DentalPin as a product page
 * (/products/dentalpin/), so this page has no counterpart and gets no hreflang alternates.
 *
 * @package Tresundios\Core
 */

defined( 'ABSPATH' ) || exit;

/**
 * Create or refresh the draft.
 *
 * @return array{id: int, created: bool}|WP_Error
 */
function tresundios_create_dentalpin_case_study() {
	global $wpdb;

	$pattern = get_stylesheet_directory() . '/patterns/case-study-dentalpin.php';
	if ( ! is_readable( $pattern ) ) {
		return new WP_Error( 'tresundios_pattern', 'Pattern not found: ' . $pattern . ' (is the tresundios-com theme active?)' );
	}
	ob_start();
	include $pattern;
	$content = trim( (string) ob_get_clean() );

	$existing = get_page_by_path( 'dentalpin-india', OBJECT, 'case_study' );
	if ( $existing && 'draft' !== $existing->post_status ) {
		return new WP_Error( 'tresundios_exists', 'dentalpin-india already exists with status "' . $existing->post_status . '"; not overwriting. Edit it in WP Admin.' );
	}

	$order = 1 + (int) $wpdb->get_var( "SELECT MAX(menu_order) FROM {$wpdb->posts} WHERE post_type = 'case_study'" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$post  = array(
		'post_type'    => 'case_study',
		'post_status'  => 'draft',
		'post_name'    => 'dentalpin-india',
		'post_title'   => 'DentalPin India: localising and deploying open-source clinic software for India',
		'post_excerpt' => 'We localised an open-source dental practice system for Indian clinics, then built the pipeline that deploys and runs it on AWS in Mumbai.',
		'post_content' => wp_slash( $content ),
		'menu_order'   => $existing ? $existing->menu_order : $order,
	);
	if ( $existing ) {
		$post['ID'] = $existing->ID;
	}
	$id = $existing ? wp_update_post( $post, true ) : wp_insert_post( $post, true );
	if ( is_wp_error( $id ) ) {
		return $id;
	}

	$meta = array(
		'client'     => 'DentalPin India (by Tresundios)',
		'industry'   => 'Dental practice software',
		'location'   => 'India',
		'tech_stack' => array( 'FastAPI', 'Nuxt', 'PostgreSQL', 'Docker', 'Coolify', 'AWS Mumbai', 'Razorpay' ),
		'card_tag'   => 'DentalPin',
		'card_cat'   => 'Dental practice software',
		'card_meta'  => array( 'FastAPI · Nuxt', 'AWS Mumbai', 'India' ),
		'card_title' => 'DentalPin India',
		'featured'   => 0,
	);
	foreach ( $meta as $key => $value ) {
		update_post_meta( $id, $key, $value );
	}
	wp_set_object_terms( $id, array( 'web' ), 'work_type' );
	tresundios_order_case_studies();

	return array(
		'id'      => (int) $id,
		'created' => ! $existing,
	);
}

/**
 * Put the DentalPin India case study first and Maria Beauty Care second; everyone else keeps their order.
 * Work lists (/work/ and the home reel) sort by menu order, then date.
 *
 * @return int Number of case studies renumbered.
 */
function tresundios_order_case_studies() {
	global $wpdb;

	$ids = get_posts(
		array(
			'post_type'      => 'case_study',
			'post_status'    => array( 'publish', 'draft', 'pending', 'private', 'future' ),
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'fields'         => 'ids',
			'no_found_rows'  => true,
		)
	);

	$first  = get_page_by_path( 'dentalpin-india', OBJECT, 'case_study' );
	$maria  = get_posts(
		array(
			'post_type'      => 'case_study',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_key'       => 'translation_key', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			'meta_value'     => 'case:maria', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
		)
	);
	$lead   = array_filter( array( $first ? $first->ID : 0, $maria ? $maria[0] : 0 ) );
	$sorted = array_values( array_unique( array_merge( $lead, $ids ) ) );

	$changed = 0;
	foreach ( $sorted as $i => $id ) {
		if ( (int) get_post_field( 'menu_order', $id ) !== $i + 1 ) {
			$wpdb->update( $wpdb->posts, array( 'menu_order' => $i + 1 ), array( 'ID' => $id ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
			clean_post_cache( $id );
			++$changed;
		}
	}
	return $changed;
}

add_action(
	'admin_menu',
	static function () {
		add_management_page(
			__( 'DentalPin case study', 'tresundios' ),
			__( 'DentalPin case study', 'tresundios' ),
			'manage_options',
			'tresundios-dentalpin-case-study',
			static function () {
				$existing = get_page_by_path( 'dentalpin-india', OBJECT, 'case_study' );
				$done     = isset( $_GET['tresundios_done'] ) ? absint( $_GET['tresundios_done'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$ordered  = isset( $_GET['tresundios_ordered'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				$error    = isset( $_GET['tresundios_error'] ) ? sanitize_text_field( wp_unslash( $_GET['tresundios_error'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				?>
				<div class="wrap">
					<h1><?php esc_html_e( 'DentalPin India case study', 'tresundios' ); ?></h1>
					<?php if ( $error ) : ?>
						<div class="notice notice-error"><p><?php echo esc_html( $error ); ?></p></div>
					<?php elseif ( $done ) : ?>
						<div class="notice notice-success"><p>
							<?php esc_html_e( 'Draft is ready, placed first in Work.', 'tresundios' ); ?>
							<a href="<?php echo esc_url( get_edit_post_link( $done, 'raw' ) ); ?>"><?php esc_html_e( 'Open it to set the featured image and publish.', 'tresundios' ); ?></a>
						</p></div>
					<?php elseif ( $ordered ) : ?>
						<div class="notice notice-success"><p><?php esc_html_e( 'Work order updated: DentalPin India first, then Maria Beauty Care, then the rest.', 'tresundios' ); ?></p></div>
					<?php endif; ?>
					<p>
						<?php
						echo $existing
							? esc_html( sprintf( /* translators: %s: post status */ __( 'The case study exists (status: %s).', 'tresundios' ), $existing->post_status ) )
							: esc_html__( 'The case study does not exist yet.', 'tresundios' );
						?>
					</p>
					<?php if ( ! $existing || 'draft' === $existing->post_status ) : ?>
						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
							<input type="hidden" name="action" value="tresundios_create_dentalpin">
							<?php wp_nonce_field( 'tresundios_create_dentalpin' ); ?>
							<?php submit_button( $existing ? __( 'Refresh the draft', 'tresundios' ) : __( 'Create the draft', 'tresundios' ) ); ?>
						</form>
					<?php endif; ?>
					<?php if ( $existing ) : ?>
						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
							<input type="hidden" name="action" value="tresundios_order_work">
							<?php wp_nonce_field( 'tresundios_order_work' ); ?>
							<?php submit_button( __( 'Put DentalPin first, then Maria Beauty Care', 'tresundios' ), 'secondary' ); ?>
						</form>
					<?php endif; ?>
				</div>
				<?php
			}
		);
	}
);

add_action(
	'admin_post_tresundios_order_work',
	static function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to do this.', 'tresundios' ), 403 );
		}
		check_admin_referer( 'tresundios_order_work' );
		tresundios_order_case_studies();
		wp_safe_redirect(
			add_query_arg(
				array(
					'page'               => 'tresundios-dentalpin-case-study',
					'tresundios_ordered' => 1,
				),
				admin_url( 'tools.php' )
			)
		);
		exit;
	}
);

add_action(
	'admin_post_tresundios_create_dentalpin',
	static function () {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have permission to do this.', 'tresundios' ), 403 );
		}
		check_admin_referer( 'tresundios_create_dentalpin' );
		$result = tresundios_create_dentalpin_case_study();
		$args   = is_wp_error( $result )
			? array( 'tresundios_error' => $result->get_error_message() )
			: array( 'tresundios_done' => $result['id'] );
		wp_safe_redirect( add_query_arg( array_merge( array( 'page' => 'tresundios-dentalpin-case-study' ), $args ), admin_url( 'tools.php' ) ) );
		exit;
	}
);
