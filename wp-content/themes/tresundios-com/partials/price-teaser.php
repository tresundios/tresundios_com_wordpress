<?php
/**
 * Prices for the current service (.com): starting price and every pricing entry linked to it.
 *
 * @package Tresundios\Theme\Com
 *
 * @var array{best: array<string, mixed>, items: array<int, array<string, mixed>>}|null $data Prices.
 */

defined( 'ABSPATH' ) || exit;

// Included from tresundios_render_template(), so these variables are function-scoped, not globals.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $data ) {
	return;
}
$best = $data['best'];
$tax  = tresundios_get( 'tax_note' );
?>
<div class="price-teaser">
	<div>
		<span class="mini-title"><?php esc_html_e( 'Pricing', 'tresundios' ); ?></span>
		<p class="price">
			<span class="price-pre"><?php esc_html_e( 'Starting from', 'tresundios' ); ?></span>
			<b class="price-amt"><?php echo esc_html( $best['amount'] ); ?></b>
			<span class="price-per"><?php echo esc_html( trim( $best['period'] . ' ' . $tax ) ); ?></span>
		</p>
	</div>
	<a class="btn-tr btn-tr-ghost" href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>"><span><?php esc_html_e( 'See all prices', 'tresundios' ); ?></span><i class="arrow" aria-hidden="true">→</i></a>
	<?php if ( count( $data['items'] ) > 1 ) : ?>
		<ul class="price-feat price-list">
			<?php foreach ( $data['items'] as $item ) : ?>
				<li><span><?php echo esc_html( $item['name'] ); ?></span><b><?php echo esc_html( $item['plain'] ); ?></b></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</div>
