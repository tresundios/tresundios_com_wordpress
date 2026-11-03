<?php
/**
 * Contact details (.com). Variants: "lines" (contact band, with copy buttons), "footer" (NAP list), "map" (/contact/ facade).
 *
 * @package Tresundios\Theme\Com
 *
 * @var array<string, mixed> $attributes Block attributes.
 * @var array<string, mixed> $data       Site settings.
 */

defined( 'ABSPATH' ) || exit;

// Included from tresundios_render_template(), so these variables are function-scoped, not globals.
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.WP.GlobalVariablesOverride.Prohibited

$tresundios_addr = sprintf( '%s, %s %s, %s, India', $data['street_address'], $data['locality'], substr( $data['postal_code'], 0, 3 ) . ' ' . substr( $data['postal_code'], 3 ), $data['region_name'] );
$tresundios_tel  = preg_replace( '/[^\d+]/', '', $data['phone'] );

if ( 'footer' === $attributes['variant'] ) :
	?>
	<address class="nap" style="font-style:normal">
		<ul>
			<li><a href="mailto:<?php echo esc_attr( $data['contact_email'] ); ?>"><?php echo esc_html( $data['contact_email'] ); ?></a></li>
			<li><a href="tel:<?php echo esc_attr( $tresundios_tel ); ?>"><?php echo esc_html( $data['phone'] ); ?></a></li>
			<li><?php echo esc_html( $data['legal_name'] ); ?>, <?php echo esc_html( $tresundios_addr ); ?></li>
		</ul>
	</address>
	<?php
	return;
endif;

if ( 'map' === $attributes['variant'] ) :
	$tresundios_q   = rawurlencode( $data['legal_name'] . ', ' . $tresundios_addr );
	$tresundios_map = $data['map_embed_url'] ? $data['map_embed_url'] : 'https://www.google.com/maps?q=' . $tresundios_q . '&output=embed';
	$tresundios_dir = $data['gbp_url'] ? $data['gbp_url'] : 'https://www.google.com/maps/search/?api=1&query=' . $tresundios_q;
	?>
	<div class="map-facade" data-map-src="<?php echo esc_url( $tresundios_map ); ?>">
		<div>
			<span class="eyebrow light"><?php esc_html_e( 'Visit us', 'tresundios' ); ?></span>
			<address><?php echo esc_html( $tresundios_addr ); ?></address>
			<div class="d-flex flex-wrap gap-2 justify-content-center">
				<button class="btn-tr btn-tr-primary" type="button" data-load-map><span><?php esc_html_e( 'Load map', 'tresundios' ); ?></span></button>
				<a class="btn-tr btn-tr-ghost" style="color:#fff;border-color:#fff" href="<?php echo esc_url( $tresundios_dir ); ?>" target="_blank" rel="noopener"><span><?php esc_html_e( 'Open in Google Maps', 'tresundios' ); ?></span><i class="arrow" aria-hidden="true">↗</i></a>
			</div>
		</div>
	</div>
	<?php
	return;
endif;

$tresundios_lines = array(
	array( __( 'Phone', 'tresundios' ), $data['phone'], 'tel:' . $tresundios_tel ),
	array( __( 'Email', 'tresundios' ), $data['contact_email'], 'mailto:' . $data['contact_email'] ),
	array( __( 'Registered office', 'tresundios' ), $tresundios_addr, '' ),
);
?>
<div class="lines">
	<?php foreach ( $tresundios_lines as $i => $line ) : ?>
		<div class="line reveal" style="--d:<?php echo esc_attr( $i * 0.06 ); ?>s">
			<div>
				<small><?php echo esc_html( $line[0] ); ?></small>
				<?php if ( $line[2] ) : ?>
					<a href="<?php echo esc_url( $line[2] ); ?>" style="text-decoration:none;color:inherit"><span><?php echo esc_html( $line[1] ); ?></span></a>
				<?php else : ?>
					<span><?php echo esc_html( $line[1] ); ?></span>
				<?php endif; ?>
			</div>
			<button class="copy" type="button" data-copy="<?php echo esc_attr( $line[1] ); ?>"><?php esc_html_e( 'Copy', 'tresundios' ); ?><span class="visually-hidden"> <?php echo esc_html( $line[0] ); ?></span></button>
		</div>
	<?php endforeach; ?>
</div>
