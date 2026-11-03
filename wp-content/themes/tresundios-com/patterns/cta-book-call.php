<?php
/**
 * Title: Book-a-call CTA
 * Slug: tresundios/cta-book-call
 * Categories: tresundios
 * Description: Dark call-to-action band with the Google Calendar booking link.
 *
 * @package Tresundios\Theme\Com
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","className":"block dark tr-sec cta-band","layout":{"type":"default"}} -->
<section class="wp-block-group block dark tr-sec cta-band"><!-- wp:group {"className":"container","layout":{"type":"default"}} -->
<div class="wp-block-group container"><!-- wp:group {"className":"sec-head mb-0","layout":{"type":"default"}} -->
<div class="wp-block-group sec-head mb-0"><!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"eyebrow"} -->
<p class="eyebrow">Let's talk</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"className":"split"} -->
<h2 class="wp-block-heading split">Ready to grow your business?</h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"reveal","layout":{"type":"default"}} -->
<div class="wp-block-group reveal"><!-- wp:paragraph -->
<p>A free 30-minute call to understand your business and goals. We reply to every enquiry within 24 hours.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"mt-4"} -->
<div class="wp-block-buttons mt-4"><!-- wp:button {"className":"magnetic has-arrow"} -->
<div class="wp-block-button magnetic has-arrow"><a class="wp-block-button__link wp-element-button" href="#book-a-call">Book a free call</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-ghost magnetic"} -->
<div class="wp-block-button is-style-ghost magnetic"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Send an enquiry</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
