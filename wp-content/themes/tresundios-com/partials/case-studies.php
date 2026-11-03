<?php
/**
 * Case-study cards (.com). Layouts: "reel" (home, pinned horizontal reel) and "grid" (archive / related).
 *
 * @package Tresundios\Theme\Com
 *
 * @var array<string, mixed>             $attributes Block attributes.
 * @var array<int, array<string, mixed>> $data       Case studies.
 */

defined( 'ABSPATH' ) || exit;

// Included from tresundios_render_template(), so these variables are function-scoped, not globals.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.WP.GlobalVariablesOverride.Prohibited

if ( empty( $data ) ) {
	return;
}

$tresundios_card = static function ( $c, $eager = false ) {
	?>
	<a class="proj tilt" href="<?php echo esc_url( $c['url'] ); ?>" data-types="<?php echo esc_attr( implode( ' ', $c['type_slugs'] ) ); ?>">
		<div class="thumb has-img">
			<?php if ( $c['tag'] ) : ?>
				<span class="mono-big"><?php echo esc_html( $c['tag'] ); ?></span>
			<?php endif; ?>
			<?php
			if ( $c['thumb_id'] ) {
				echo wp_get_attachment_image(
					$c['thumb_id'],
					'large',
					false,
					array(
						'alt'      => '',
						'loading'  => $eager ? 'eager' : 'lazy',
						'decoding' => 'async',
						'sizes'    => '(min-width: 992px) 440px, 90vw',
						'style'    => 'object-position:' . ( $c['focal'] ? $c['focal'] : '50% 50%' ),
					)
				);
			}
			?>
		</div>
		<div class="body">
			<div class="meta">
				<span class="cat"><?php echo esc_html( $c['card_cat'] ); ?></span>
				<?php foreach ( $c['card_meta'] as $bit ) : ?>
					<span><?php echo esc_html( $bit ); ?></span>
				<?php endforeach; ?>
			</div>
			<h3><?php echo esc_html( $c['card_title'] ); ?></h3>
			<p><?php echo esc_html( $c['excerpt'] ); ?></p>
			<span class="more"><?php esc_html_e( 'View case study', 'tresundios' ); ?> <i aria-hidden="true">→</i></span>
		</div>
	</a>
	<?php
};

if ( 'reel' === $attributes['layout'] ) :
	?>
	<div class="hs-track" id="hsTrack">
		<?php
		foreach ( $data as $c ) {
			$tresundios_card( $c );
		}
		?>
		<div class="proj-end">
			<span class="eyebrow"><?php esc_html_e( 'Your turn', 'tresundios' ); ?></span>
			<?php /* translators: %s: next case-study number, e.g. 07. */ ?>
			<h3><?php echo esc_html( sprintf( __( 'Your business could be case study %s.', 'tresundios' ), sprintf( '%02d', count( $data ) + 1 ) ) ); ?></h3>
			<a class="btn-tr btn-tr-primary magnetic" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span><?php esc_html_e( 'Start a project', 'tresundios' ); ?></span><i class="arrow" aria-hidden="true">→</i></a>
		</div>
	</div>
	<?php
	return;
endif;

if ( $attributes['filters'] ) :
	$tresundios_types = get_terms(
		array(
			'taxonomy'   => 'work_type',
			'hide_empty' => true,
		)
	);
	$tresundios_now   = is_tax( 'work_type' ) ? get_queried_object_id() : 0;
	?>
	<nav class="filters mb-4" aria-label="<?php esc_attr_e( 'Filter case studies', 'tresundios' ); ?>" data-work-filters>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'case_study' ) ); ?>" data-filter="all"<?php echo $tresundios_now ? '' : ' aria-current="page"'; ?>><?php esc_html_e( 'All', 'tresundios' ); ?></a>
		<?php foreach ( is_wp_error( $tresundios_types ) ? array() : $tresundios_types as $tresundios_t ) : ?>
			<a href="<?php echo esc_url( get_term_link( $tresundios_t ) ); ?>" data-filter="<?php echo esc_attr( $tresundios_t->slug ); ?>"<?php echo $tresundios_now === $tresundios_t->term_id ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $tresundios_t->name ); ?></a>
		<?php endforeach; ?>
	</nav>
	<?php
endif;
?>
<div class="work-grid" data-work-grid>
	<?php
	foreach ( $data as $i => $c ) {
		$tresundios_card( $c, 0 === $i && ! empty( $attributes['filters'] ) );
	}
	?>
</div>
