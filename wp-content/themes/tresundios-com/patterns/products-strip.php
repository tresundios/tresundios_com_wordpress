<?php
/**
 * Title: Products we build and run
 * Slug: tresundios/products-strip
 * Categories: tresundios
 * Description: Small strip with one card, DentalPin India, linking to its case study. Not a sales section and not in the main navigation.
 *
 * @package Tresundios\Theme\Com
 */

defined( 'ABSPATH' ) || exit;

$tresundios_case_url = esc_url( home_url( '/work/dentalpin-india/' ) );
?>
<!-- wp:group {"tagName":"section","anchor":"products","className":"block tight tr-sec products-strip","layout":{"type":"default"}} -->
<section id="products" class="wp-block-group block tight tr-sec products-strip"><!-- wp:group {"className":"container","layout":{"type":"default"}} -->
<div class="wp-block-group container"><!-- wp:heading {"className":"eyebrow"} -->
<h2 class="wp-block-heading eyebrow"><?php esc_html_e( 'Products we build and run', 'tresundios' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:html -->
<div class="row mt-4">
	<div class="col-lg-6 reveal">
		<div class="card-m product-card">
			<p class="mini-title"><?php esc_html_e( 'Our India product', 'tresundios' ); ?></p>
			<h3><a href="<?php echo $tresundios_case_url; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above. ?>"><?php esc_html_e( 'DentalPin India', 'tresundios' ); ?><span class="visually-hidden"> <?php esc_html_e( '(read the case study)', 'tresundios' ); ?></span></a></h3>
			<p><?php esc_html_e( 'Dental practice software we localised and run for clinics in India, with GST billing, WhatsApp reminders and a 7-language interface.', 'tresundios' ); ?></p>
			<p class="product-note"><?php esc_html_e( 'Tresundios is the exclusive licensee of DentalPin for India.', 'tresundios' ); ?></p>
			<span class="view-link" aria-hidden="true"><?php esc_html_e( 'Read the case study', 'tresundios' ); ?> <i>→</i></span>
		</div>
	</div>
</div>
<!-- /wp:html --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
