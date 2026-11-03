<?php
/**
 * Single case study body (.com): the former modal, now a crawlable page.
 *
 * @package Tresundios\Theme\Com
 *
 * @var array<string, mixed>|null $data Case study.
 */

defined( 'ABSPATH' ) || exit;

// Included from tresundios_render_template(), so these variables are function-scoped, not globals.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $data ) {
	return;
}
?>
<article class="case-page">
	<div class="row g-4 align-items-center case-hero">
		<div class="col-md-6">
			<div class="thumb has-img">
				<?php if ( $data['tag'] ) : ?>
					<span class="mono-big"><?php echo esc_html( $data['tag'] ); ?></span>
				<?php endif; ?>
				<?php
				if ( $data['thumb_id'] ) {
					echo wp_get_attachment_image(
						$data['thumb_id'],
						'large',
						false,
						array(
							'loading'       => 'eager',
							'fetchpriority' => 'high',
							'sizes'         => '(min-width: 768px) 50vw, 100vw',
							'style'         => 'object-position:' . ( $data['focal'] ? $data['focal'] : '50% 50%' ),
						)
					);
				}
				?>
			</div>
		</div>
		<div class="col-md-6">
			<?php
			if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
				rank_math_the_breadcrumbs(); }
			?>
			<div class="meta"><span class="cat"><?php echo esc_html( $data['industry'] ); ?></span></div>
			<h1><?php echo esc_html( $data['title'] ); ?></h1>
			<div class="row g-3 mt-1">
				<div class="col-6 col-sm-4"><div class="fact"><small><?php esc_html_e( 'Client', 'tresundios' ); ?></small><b><?php echo esc_html( $data['client'] ); ?></b></div></div>
				<div class="col-6 col-sm-4"><div class="fact"><small><?php esc_html_e( 'Duration', 'tresundios' ); ?></small><b><?php echo esc_html( $data['duration'] ); ?></b></div></div>
				<div class="col-12 col-sm-4"><div class="fact"><small><?php esc_html_e( 'Market', 'tresundios' ); ?></small><b><?php echo esc_html( $data['location'] ); ?></b></div></div>
			</div>
			<?php if ( $data['tech'] ) : ?>
				<ul class="stack list-unstyled" aria-label="<?php esc_attr_e( 'Technology', 'tresundios' ); ?>">
					<?php foreach ( $data['tech'] as $t ) : ?>
						<li class="chip"><?php echo esc_html( $t ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>

	<div class="row g-3">
		<section class="col-md-6"><div class="case-block"><h2 class="h3-like"><?php esc_html_e( 'The challenge', 'tresundios' ); ?></h2><p><?php echo esc_html( $data['challenge'] ); ?></p></div></section>
		<section class="col-md-6"><div class="case-block"><h2 class="h3-like"><?php esc_html_e( 'What we built', 'tresundios' ); ?></h2><p><?php echo esc_html( $data['solution'] ); ?></p></div></section>
	</div>

	<?php if ( $data['results'] ) : ?>
		<section aria-labelledby="results-title">
			<h2 class="eyebrow" id="results-title"><?php esc_html_e( 'Results achieved', 'tresundios' ); ?></h2>
			<div class="row g-3 mt-1">
				<?php foreach ( $data['results'] as $r ) : ?>
					<div class="col-md-4"><div class="result"><b><?php echo esc_html( $r['label'] ); ?></b><?php echo esc_html( $r['text'] ); ?></div></div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<div class="case-foot">
		<div class="d-flex flex-wrap gap-2">
			<?php if ( $data['live_url'] ) : ?>
				<a class="btn-tr btn-tr-ghost" href="<?php echo esc_url( $data['live_url'] ); ?>" target="_blank" rel="noopener"><span><?php esc_html_e( 'Visit live site', 'tresundios' ); ?></span><span class="visually-hidden"> <?php esc_html_e( '(opens in a new tab)', 'tresundios' ); ?></span><i class="arrow" aria-hidden="true">↗</i></a>
			<?php endif; ?>
			<a class="btn-tr btn-tr-ghost" href="<?php echo esc_url( get_post_type_archive_link( 'case_study' ) ); ?>"><span><?php esc_html_e( 'All case studies', 'tresundios' ); ?></span></a>
		</div>
		<a class="btn-tr btn-tr-primary magnetic" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span><?php esc_html_e( 'Start a project like this', 'tresundios' ); ?></span><i class="arrow" aria-hidden="true">→</i></a>
	</div>
</article>
