<?php
/**
 * Service cards (.com): dark band cards linking to each service and sub-service.
 *
 * @package Tresundios\Theme\Com
 *
 * @var array<int, array<string, mixed>> $data Services.
 */

defined( 'ABSPATH' ) || exit;

// Included from tresundios_render_template(), so these variables are function-scoped, not globals.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.WP.GlobalVariablesOverride.Prohibited

if ( empty( $data ) ) {
	return;
}
?>
<div class="row g-4 row-cols-1 row-cols-md-2">
	<?php foreach ( $data as $i => $s ) : ?>
		<div class="col reveal" style="--d:<?php echo esc_attr( ( $i % 2 ) * 0.1 ); ?>s">
			<article class="svc tilt">
				<div class="d-flex justify-content-between align-items-start gap-3">
					<div class="ic"><?php echo tresundios_icon( $s['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG. ?></div>
					<span class="num"><?php echo esc_html( $s['num'] ); ?></span>
				</div>
				<h3><a class="svc-link" href="<?php echo esc_url( $s['url'] ); ?>"><?php echo esc_html( $s['title'] ); ?></a></h3>
				<p><?php echo esc_html( $s['excerpt'] ); ?></p>
				<?php if ( $s['children'] ) : ?>
					<ul>
						<?php foreach ( $s['children'] as $child ) : ?>
							<li><a href="<?php echo esc_url( $child['url'] ); ?>"><?php echo esc_html( $child['title'] ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</article>
		</div>
	<?php endforeach; ?>
</div>
